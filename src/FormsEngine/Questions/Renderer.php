<?php
namespace FormsEngine\Questions;

use PhpCollection\Sequence;

class Renderer {

  private $twig;
  private $elements;
  private $formTitle;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
  }

  // todo set dir??
  public function render($dir=null){
    if ($dir!=null){
      $this->setTemplateDir($dir);
    }

    if (!isset($_SESSION['hasSubmitted']) OR !$_SESSION['hasSubmitted']){
      $elements = $this->prepareElements();

      // echo HTML Form
      echo $this->twig->render('form.html',
                      ['elements' => $elements['rawElements']]);

      // echo JS
      if (\sizeof($elements['scriptElements'])>0){
        echo $this->twig->render('scripts.html',
                      ['scripts' => $elements['scriptElements']]);
      }
    }
    else {
      $title = ['formTitle' => ''];
      if (!empty($this->formTitle)){
        $title['formTitle'] = $this->formTitle->render($this->twig);
      }
      echo $this->twig->render('message.html',$title);
    }
  }

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

  public function load($deserializedForm){
    $this->deserialize($deserializedForm);
    $this->render();
  }

  public function add($element){
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = $element;
    }
    $this->elements->add($element);
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
    foreach ($this->elements as $element) {
      \array_push($serialization, $element->serialize());
    }
    return \json_encode($serialization);
  }

  public function deserialize($string){
    $serialization = \json_decode($string);
    foreach ($serialization as $element) {
      // todo from element array to element
      $class = 'FormsEngine\Questions\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $this->add($instance);
      }
    }
  }
}
?>
