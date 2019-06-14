<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Submit extends Button {

  public function __construct(
                            $label) {
      $this->type = Type::SUBMIT()->getValue();
      parent::__construct($label, true);
  }
}
?>
