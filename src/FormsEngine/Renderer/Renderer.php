<?php
namespace FormsEngine\Renderer;

use PhpCollection\Sequence;

class Renderer {

  private $twig;
  private $elements;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
  }

  // todo difference between render and wizard??
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
    // todo "json" to Elements wrapper?!
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
}
?>
