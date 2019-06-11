<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Checkbox extends Element {

  private $checked;

  public function __construct($label, $value, $checked = false) {
      parent::__construct($label);
      $this->type = FieldType::CHECKBOX()->getValue();
      $this->value = $value;
      $this->checked = $checked;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['checked'] = $this->checked;
    return $vars;
  }
}
?>
