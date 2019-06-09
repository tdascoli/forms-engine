<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class ElementGroup {

  private $elements;

  public function __construct($elements) {
    $this->elements = $elements;
  }
}
?>
