<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Hidden extends Element {

  public function __construct($id) {
      $this->type = Type::HIDDEN()->getValue();
      $this->id = $id;
  }

  public function render($twig){
    $template = $twig->load('plain-input.html');
    return $template->render(parent::prepare());
  }
}
?>
