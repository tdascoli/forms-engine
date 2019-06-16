<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class Page {

  public $page;
  private $elements;

  public function __construct($page){
    $this->page = $page;
    $this->elements = new Sequence();
  }

  // todo render?
  public function prepareElements() {
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

  public function page(){
    return $this->page;
  }

  public function serialize() {
    $serialization = array('page' => $this->page, 'elements' => array());
    foreach ($this->elements as $element) {
      \array_push($serialization['elements'], $element->serialize());
    }
    return \json_encode($serialization);
  }

  public function deserialize($string){
    $serialization = \json_decode($string);

    $this->page = $serialization['page'];

    foreach ($serialization['elements'] as $element) {
      $class = 'FormsEngine\Questions\Element\\'.ucfirst($element->type);
      $instance = $class::deserialize($element);
      if (is_object($instance)){
        $this->add($instance);
      }
    }
  }
}
?>
