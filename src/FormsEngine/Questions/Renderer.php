<?php
namespace FormsEngine\Questions;

use PhpCollection\Map;
use PhpCollection\Sequence;
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
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->pages = new Sequence();
    $this->pagination = new Pagination();
  }

  // todo set dir??
  public function render($dir=null){
    if ($dir!=null){
      $this->setTemplateDir($dir);
    }

    if (!$this->displayMessage()){
      $pages = $this->prepare();

      echo $this->twig->render('form.html',
                      ['pages' => $pages,
                       'pagination' => $this->pagination->prepare(),
                        $this->prepareTitle()]);
    }
    else {
      echo $this->twig->render('message.html',$this->prepareTitle());
    }
  }

  private function prepareTitle(){
    $title = array('formTitle' => '');
    if (!empty($this->formTitle)){
      $title['formTitle'] = $this->formTitle->render($this->twig);
    }
    return $title;
  }

  private function displayMessage(){
    if (!isset($_SESSION['hasSubmitted']) OR !$_SESSION['hasSubmitted']){
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

  // todo check if formTitle alread set -> only one title allowed!!
  public function addTitle($title, $description=null){
    if (\is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = new Title($title, $description);
    }
  }

  public function addRequired($element){
    $element->required();
    $this->add($element);
  }

  public function setTemplateDir($dir){
    RenderConfig::updateTemplateDir($dir);
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
  }

  public function serialize() {
    $serialization = array();
    if ($this->formTitle != null){
        $serialization['formTitle'] = $this->formTitle->serialize();
    }
    foreach ($this->pages as $page) {
      \array_push($serialization['pages'], $page->serialize());
    }
    return \json_encode($serialization);
  }

  public function deserialize($string){
    $serialization = \json_decode($string);
    if ($serialization['formTitle'] != null){
        $class = 'FormsEngine\Questions\Element\Title\\';
        $instance = $class::deserialize($serialization['formTitle']);
        if (is_object($instance)){
            $this->formTitle = $instance;
        }
    }
    foreach ($serialization['pages'] as $page) {
      $class = 'FormsEngine\Questions\Pagination\Page\\';
      $instance = $class::deserialize($page);
      if (is_object($instance)){
        $this->addPage($instance);
      }
    }
  }
}
?>
