<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Number extends Input {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = FieldType::NUMBER()->getValue();
  }
}
?>
