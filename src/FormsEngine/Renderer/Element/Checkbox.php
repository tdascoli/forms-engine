<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Checkbox extends Element {

  private $checked;

  public function __construct($label, $value, $checked = false) {
      parent::__construct($label);
      $this->type = Type::CHECKBOX()->getValue();
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
