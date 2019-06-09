<?php
namespace FormsEngine\Renderer;

use FormsEngine\Renderer\Element as Element;
use PhpCollection\Sequence;

class Renderer {

  private $twig;

  private $elements;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/Templates/');
    $this->twig = new \Twig\Environment($loader);
    $this->elements = new Sequence();
  }

  public function render($legend=null){
    echo $this->twig->render('form.html', ['legend' => $legend, 'elements' => $this->rawElements()]);
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
}
?>
