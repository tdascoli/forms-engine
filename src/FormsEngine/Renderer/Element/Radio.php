<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Radio extends Element {

  private $name;
  private $checked;

  public function __construct($label, $value, $name, $checked = false) {
      parent::__construct($label);
      $this->type = FieldType::RADIO()->getValue();
      $this->value = $value;
      $this->name = $name;
      $this->checked = $checked;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['name'] = $this->name;
    $vars['checked'] = $this->checked;
    return $vars;
  }
}
?>