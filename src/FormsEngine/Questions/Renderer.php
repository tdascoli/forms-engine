<?php
namespace FormsEngine\Questions;

use PhpCollection\Sequence;
use FormsEngine\Config;
use FormsEngine\Questions\Pagination\Page;
use FormsEngine\Questions\Pagination\Pagination;
use FormsEngine\Questions\Element\Title;

// todo add/addRequired etc. make interface, also for Page

class Renderer {

  private $twig;
  private $pages;
  private $pagination;
  private $formTitle;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->pages = new Sequence();
    $this->pagination = new Pagination();
  }

  public function render(){
    $title = $this->prepareTitle();

    if (!$this->displayMessage()){
      $pages = $this->prepare();
      echo $this->twig->render('form.html',
                      ['pages' => $pages,
                       'pagination' => $this->pagination->prepare(\sizeof($this->pages)),
                       'formName' => Config::$name,
                       'formTitle' => $title]);
    }
    else {
      echo $this->twig->render('message.html',
                      ['formTitle' => $title,
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

  public function load($deserializedForm){
    $this->deserialize($deserializedForm);
    $this->render();
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

  public function deserialize($data){
    if (!\is_object($data)){
        $serialization = \json_decode($data);
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
