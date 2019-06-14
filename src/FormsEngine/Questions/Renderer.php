<?php
namespace FormsEngine\Questions;

use PhpCollection\Sequence;

class Renderer {

  private $twig;
  private $elements;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(RenderConfig::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
  }

  // todo difference between render and wizard??
  // todo set dir??
  public function render($dir=null){
    if ($dir!=null){
      $this->setTemplateDir($dir);
    }

    // todo form handler??

    echo $this->twig->
                  render('form.html',
                    ['elements' => $this->rawElements()]);
  }

  public function load($form){
    // todo deserialize and render
    $this->render();
  }

  public function add($element){
    $this->elements->add($element);
  }

  private function rawElements(){
    $rawElements = array();
    foreach ($this->elements as $element) {
      array_push($rawElements, $element->render($this->twig));
    }
    return $rawElements;
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
      $class = 'FormsEngine\Renderer\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $this->add($instance);
      }
    }
  }
}
?>
