<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class CustomCheckbox extends Element {

  public function __construct($label, $value) {
      parent::__construct($label);
      $this->type = FieldType::CHECKBOX()->getValue();
      $this->label = $label;
      $this->value = $value;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render(parent::prepare());
  }
}
?>
