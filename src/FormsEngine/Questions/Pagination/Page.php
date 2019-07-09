<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class Page {

  private $elements;
  private $elementKeys;
  // private $condition;

  public function __construct(){
    $this->elements = new Sequence();
    $this->elementKeys = new Sequence();
  }

  public function prepareElements($twig) {
    $rawElements = array();
    $scriptElements = array();

    foreach ($this->elements as $element) {
      array_push($rawElements, $element->render($twig));
      $script = $element->script();
      if (!empty($script)){
        \array_push($scriptElements, $script);
      }
    }
    return array('elements' => $rawElements,
                 'scripts' => $scriptElements);
  }

  public function elementKeys(){
    return $this->elementKeys;
  }

  public function add($element){
      // todo throw/log
    if (!is_a($element, 'FormsEngine\Questions\Element\Title')){
        $this->elements->add($element);
        $this->elementKeys->add($element->name);
    }
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
    return $serialization;
  }

  public static function deserialize($object){
    $page = new Page();
    foreach ($object as $element) {
      $class = 'FormsEngine\Questions\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $page->add($instance);
      }
    }
    return $page;
  }
}
?>
