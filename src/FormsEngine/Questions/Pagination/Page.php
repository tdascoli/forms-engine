<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class Page {

  private $elements;

  public function __construct(){
    $this->elements = new Sequence();
  }

  // todo render?
  public function prepareElements($twig) {
    $rawElements = array();
    $scriptElements = array();

    foreach ($this->elements as $element) {
      array_push($rawElements, $element->render($twig));
      $script = $element->script();
      if (!empty($script)){
        array_push($scriptElements, $script);
      }
    }

    return array('elements' => $rawElements,
                 'scripts' => $scriptElements);
  }

  public function add($element){
    /* todo
    if (is_a($element, 'FormsEngine\Questions\Element\Title')){
      $this->formTitle = $element;
    }
    */
    $this->elements->add($element);
  }

  public function addRequired($element){
    $element->required();
    $this->add($element);
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
      $class = 'FormsEngine\Questions\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $this->add($instance);
      }
    }
  }
}
?>
