<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Select extends Input {

  private $options;

  public function __construct($label,
                              $options) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = FieldType::SELECT()->getValue();
  }
}
?>
