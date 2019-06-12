<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class DateTime extends Input {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = Type::DATETIME()->getValue();
  }
}
?>
