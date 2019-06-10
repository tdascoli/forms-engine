<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Date extends Input {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = FieldType::DATE()->getValue();
  }
}
?>
