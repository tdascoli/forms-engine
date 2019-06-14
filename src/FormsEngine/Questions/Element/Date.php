<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Date extends Input {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = Type::DATE()->getValue();
  }
}
?>
