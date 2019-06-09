<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class CustomInputGroup extends Element {

  public function __construct($label, $value) {
      parent::__construct($label);
      $this->label = $label;
      $this->value = $value;
  }

  public function render($twig){
    $template = $twig->load('custom-input-group.html');
    return $template->render(parent::prepare());
  }
}
?>
