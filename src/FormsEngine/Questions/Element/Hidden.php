<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Hidden extends Element {

  public function __construct($id) {
      $this->type = Type::HIDDEN()->getValue();
      $this->setId($id,true);
  }

  public function render($twig){
    $template = $twig->load('plain-input.html');
    return $template->render(parent::prepare());
  }
}
?>
