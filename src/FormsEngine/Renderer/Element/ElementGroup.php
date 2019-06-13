<?php
namespace FormsEngine\Renderer\Element;

use PhpCollection\Sequence;

abstract class ElementGroup {

  /** @var array */
  private $elements;

  /** @var string */
  private $type;

  public function __construct($elements) {
    $this->elements = new Sequence();
    if (\is_array($elements)){
      foreach ($elements as $element) {
        $this->elements->add($element);
      }
    }
  }

  public function render($twig){
    $rawElements = '';
    foreach($this->elements as $element){
      $rawElements .= $element->render($twig);
    }
    return $rawElements;
  }

  public function elements(){
    return $this->elements;
  }

  public function toObjectVar($key, $value, $class = null){
    if ($class == null){
        $class = $this;
    }
    if (\property_exists($class, $key)){
      $class->{$key} = $value;
    }
  }
}
?>
