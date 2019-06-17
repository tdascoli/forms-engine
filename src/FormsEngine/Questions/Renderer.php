<?php
namespace FormsEngine\Questions;

use PhpCollection\Map;
use PhpCollection\Sequence;
use FormsEngine\Questions\Pagination\Page;
use FormsEngine\Questions\Pagination\Pagination;
use FormsEngine\Questions\Element\Title;

class Renderer {

  private $twig;
  private $elements;
  private $formTitle;
  private $pagination;

  private $pageElements;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
    $this->pagination = new Pagination();

    $this->pageElements = new Sequence();
  }

  // todo set dir??
  // todo page
  public function render($dir=null){
    if ($dir!=null){
      $this->setTemplateDir($dir);
    }

    if (!$this->displayMessage()){
      $elements = $this->prepareElements();

      // echo HTML Form
      echo $this->twig->render('form.html',
                      ['elements' => $elements['rawElements'],
                       'pagination' => $this->pagination->prepare(),
                       'scripts' => $elements['scriptElements']]);
    }
    else {
      echo $this->twig->render('message.html',$this->prepareTitle());
    }
  }

  // page
  private function prepareElements() {
    $rawElements = array();
    $scriptElements = array();

    foreach ($this->elements as $element) {
      array_push($rawElements, $element->render($this->twig));
      $script = $element->script();
      if (!empty($script)){
        array_push($scriptElements, $script);
      }
    }

    return array('rawElements' => $rawElements,
                 'scriptElements' => $scriptElements);
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

  // page
  public function add($element){
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = $element;
    }
    $this->elements->add($element);
  }

  // PAGE ---
  public function renderP(){
    if (!$this->displayMessage()){
      $pages = $this->prepareP();
      // echo HTML Form
      echo $this->twig->render('formP.html',
                      ['pages' => $pages,
                       'pagination' => $this->pagination->prepare()]);
    }
    else {
      echo $this->twig->render('message.html',$this->prepareTitle());
    }
  }

  private function prepareP(){
    $pages = array();

    foreach ($this->pageElements as $element) {
      array_push($pages, $element->prepareElements($this->twig));
    }

    return $pages;
  }

  public function addP($element){
    // todo
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = $element;
    }
    if (\sizeof($this->pageElements)==0){
        $this->addPage(new Page());
    }
    $page = $this->pageElements->first();
    $page->add($element);
  }

  public function addPage($page){
      if (\is_a($page, 'FormsEngine\Questions\Pagination\Page')){
        $this->pageElements->add($page);
      }
  }
  // END PAGE ---

  // todo check if formTitle alread set -> only one title allowed!!
  // todo no addTitle Element in Pages!!
  public function addTitle($title, $description=null){
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = new Title($title, $description);
      $this->add($this->formTitle);
    }
  }

  // page
  public function addRequired($element){
    $element->required();
    $this->add($element);
  }

  public function setTemplateDir($dir){
    RenderConfig::updateTemplateDir($dir);
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
  }

  // todo -> page
  public function serialize() {
    $serialization = array();
    foreach ($this->elements as $element) {
      \array_push($serialization, $element->serialize());
    }
    return \json_encode($serialization);
  }

  // todo -> page
  public function deserialize($string){
    $serialization = \json_decode($string);
    foreach ($serialization as $element) {
      $class = 'FormsEngine\Questions\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $this->add($instance);
      }
    }
  }
}
?>
