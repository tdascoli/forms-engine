<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

// TODO really extends from Element?

class Button extends Element {

  private $primary;

  public function __construct(
                            $label,
                            $primary = false) {
      $this->type = FieldType::BUTTON();
      $this->primary = $primary;
  }

  public function render($twig){
    $template = $twig->load('button.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    // todo style??
    $vars['class'] = $this->btnClass();
    return $vars;
  }

  private function btnClass(){
    if ($this->primary){
      return 'btn-primary';
    }
    return 'btn-secondary';
  }
}
?>
