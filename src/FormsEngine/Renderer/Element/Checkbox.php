<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Checkbox extends Element {

  public function __construct($label, $value, $checked = false) {
      parent::__construct($label);
      $this->type = FieldType::CHECKBOX()->getValue();
      $this->value = $value;
      // todo checked
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render(parent::prepare());
  }
}
?>
