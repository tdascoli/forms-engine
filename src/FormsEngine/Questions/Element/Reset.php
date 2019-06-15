<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Reset extends Button {

  public function __construct($label) {
      $this->type = Type::RESET()->getValue();
      parent::__construct($label, ButtonType::RESET());
  }
}
?>
