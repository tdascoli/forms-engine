<?php
namespace FormsEngine\Questions;

use PhpCollection\Sequence;
use FormsEngine\Config;
use FormsEngine\Questions\Element\Title;
use FormsEngine\Questions\Loader\Loader;
use FormsEngine\Questions\Pagination\Page;

class Renderer implements AbstractPage {

  private $twig;
  private $pages;
  private $formTitle;
  private $loader;
  private $keys;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::getInstance()->get('templateDir'));
    $this->twig = new \Twig\Environment($loader);
    $this->pages = new Sequence();
    $this->loader = new Loader(Config::getInstance()->get('render','load'),
                               Config::getInstance()->get('render','config'));
  }

  public function render(){
    $title = $this->prepareTitle();

    if (!$this->displayMessage()){
      $pages = $this->prepare();

      $params = array('pages' => $pages,
                      'method' => Config::getInstance()->get('form','method'),
                      'formName' => Config::getInstance()->get('form','name'),
                      'formTitle' => $title);

      $pagination = array('active' => Config::getInstance()->get('pagination','active'),
                          'reset' => Config::getInstance()->get('pagination','reset'));
      if (Config::getInstance()->get('pagination','active')){
        $pagination = \array_merge($pagination,
                                  array('translations' => array(
                                    'back' => \L::pagination_back,
                                    'next' => \L::pagination_next,
                                    'reset' => \L::pagination_reset,
                                    'submit' => \L::pagination_submit
                                  )));
      }
      $params = \array_merge($params, array('pagination' => $pagination));

      if (Config::getInstance()->get('form','method')=='ajax'){
        $params = \array_merge($params,
                               array('exception' => \L::exception_stored,
                                     'message' => \L::message_stored,
                                     'createAnother' => Config::getInstance()->get('form','createAnother'),
                                     'another' => array(
                                          'link' => $_SERVER['REQUEST_URI'],
                                          'text' => \L::pagination_createAnother)));
      }
      else {
        $params =
          \array_merge($params,
                        array('keys'=> \base64_encode(\json_encode($this->elementKeys()))));
      }

      echo $this->twig->render('form.html', $params);
    }
    else {
      echo $this->twig->render('message.html',
                      ['formTitle' => $title,
                       'message' => \L::message_stored,
                       'createAnother' => Config::getInstance()->get('form','createAnother'),
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

  private function prepare(){
    $pages = array();
    foreach ($this->pages as $page) {
      \array_push($pages, $page->prepareElements($this->twig));
    }
    return $pages;
  }

  private function displayMessage(){
    if (!isset($_SESSION['hasSubmitted']) OR
        !$_SESSION['hasSubmitted'] OR
        !Config::getInstance()->get('form','messageAfterSubmit')){
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

  public function addRequired($element){
    $element->required();
    $this->add($element);
  }

  public function elementKeys(){
    if (!\is_array($this->keys)){
      $this->keys=new Sequence();
      foreach ($this->pages as $element) {
        $this->keys->addAll($element->elementKeys()->all());
      }
    }
    return $this->keys->all();
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
