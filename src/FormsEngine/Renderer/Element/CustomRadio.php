<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class CustomRadio extends CustomInputGroup {

  public function __construct($label) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = FieldType::RADIO()->getValue();
  }
}
?>
