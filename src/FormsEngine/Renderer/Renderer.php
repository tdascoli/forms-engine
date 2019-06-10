<?php
namespace FormsEngine\Renderer;

use FormsEngine\Renderer\Element as Element;
use PhpCollection\Sequence;

class Renderer {

  private $twig;
  private $elements;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
  }

  public function render($dir=null){
    if ($dir!=null){
      $this->setTemplateDir($dir);
    }

    echo $this->twig->
                  render('form.html',
                    ['elements' => $this->rawElements()]);
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
    Config::updateTemplateDir($dir);
    $loader = new \Twig\Loader\FilesystemLoader(Config::$templateDir);
    $this->twig = new \Twig\Environment($loader);
  }
}
?>
