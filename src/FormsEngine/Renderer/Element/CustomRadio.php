<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class CustomRadio extends Element {

  private $name;

  public function __construct($label, $value, $name) {
      parent::__construct($label);
      $this->type = FieldType::RADIO()->getValue();
      $this->label = $label;
      $this->value = $value;
      $this->name = $name;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['name'] = $this->name;
    return $vars;
  }
}
?>
