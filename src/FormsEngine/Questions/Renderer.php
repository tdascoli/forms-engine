<?php
namespace FormsEngine\Questions;

use PhpCollection\Sequence;
use FormsEngine\Config;
use FormsEngine\Questions\Element\Title;
use FormsEngine\Questions\Loader\Loader;
use FormsEngine\Questions\Pagination\Page;
use FormsEngine\Questions\Pagination\Pagination;

// todo add/addRequired etc. make interface, also for Page

class Renderer {

  private $twig;
  private $pages;
  private $pagination;
  private $formTitle;
  private $loader;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->pages = new Sequence();
    $this->pagination = new Pagination();
    $this->loader = new Loader(Config::$loader, Config::$loaderConfig);
  }

  public function render(){
    $title = $this->prepareTitle();

    if (!$this->displayMessage()){
      $pages = $this->prepare();

      $params = array('pages' => $pages,
                      'method' => Config::$method,
                      'pagination' => $this->pagination->prepare(\sizeof($this->pages)),
                      'formName' => Config::$name,
                      'formTitle' => $title);

      if (Config::$method=='ajax'){
        $params = \array_merge($params,
                               array('message' => \L::message_stored,
                                     'createAnother' => Config::$createAnother,
                                     'another' => array(
                                          'link' => $_SERVER['REQUEST_URI'],
                                          'text' => \L::pagination_createAnother)));
      }

      echo $this->twig->render('form.html', $params);
    }
    else {
      echo $this->twig->render('message.html',
                      ['formTitle' => $title,
                       'message' => \L::message_stored,
                       'createAnother' => Config::$createAnother,
                       'another' => array(
                                      'link' => $_SERVER['REQUEST_URI'],
                                      'text' => \L::pagination_createAnother)]);
    }
  }

  private function prepareTitle(){
    $title = '';
    if ($this->formTitle!=null){
      $title = $this->formTitle->render($this->twig);
    }
    return $title;
  }

  private function displayMessage(){
    if (!isset($_SESSION['hasSubmitted']) OR
        !$_SESSION['hasSubmitted'] OR
        !Config::$messageAfterSubmit){
      return false;
    }
    return true;
  }

  public function load(){
    $deserializedForm = $this->loader->load();
    if (!empty($deserializedForm)){
      $this->deserialize($deserializedForm);
      $this->render();
    }
    else {
      echo $this->twig->render('no-form.html',
                      ['message' => \L::message_noForm]);
    }
  }

  private function prepare(){
    $pages = array();
    foreach ($this->pages as $page) {
      array_push($pages, $page->prepareElements($this->twig));
    }
    return $pages;
  }

  public function add($element){
      // todo optionals
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = $element;
    }
    else {
        if (\sizeof($this->pages)==0){
            $this->addPage(new Page());
        }
        $page = $this->pages->first();
        $page->get()->add($element);
    }
  }

  public function addPage($page){
      if (\is_a($page, 'FormsEngine\Questions\Pagination\Page')){
        $this->pages->add($page);
      }
  }

  public function addTitle($title, $description=null){
    // todo throw/log
    if ($this->formTitle == null){
      if (\is_a($element, 'FormsEngine\Questions\Element\Title')){
        $this->formTitle = new Title($title, $description);
      }
    }
  }

  public function addRequired($element){
    $element->required();
    $this->add($element);
  }

  public function setTemplateDir($dir){
    Config::updateTemplateDir($dir);
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
  }

  public function serialize() {
    $serialization = array('formTitle' => '', 'pages' => array());
    if ($this->formTitle != null){
        $serialization['formTitle'] = $this->formTitle->serialize();
    }
    foreach ($this->pages as $page) {
      \array_push($serialization['pages'], $page->serialize());
    }
    return \json_encode($serialization);
  }

  public function deserialize($serialization){
    if (!\is_object($serialization)){
        $serialization = \json_decode($serialization);
    }
    if ($serialization->formTitle != null){
        $class = 'FormsEngine\Questions\Element\Title';
        $instance = $class::deserialize($serialization->formTitle);
        if (is_object($instance)){
            $this->formTitle = $instance;
        }
    }

    foreach ($serialization->pages as $page) {
      $class = 'FormsEngine\Questions\Pagination\Page';
      $instance = $class::deserialize($page);
      if (is_object($instance)){
        $this->addPage($instance);
      }
    }
  }
}
?>
