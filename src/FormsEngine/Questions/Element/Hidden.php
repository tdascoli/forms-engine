<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Hidden extends Element {

  public function __construct($id, $value = null) {
      $this->type = Type::HIDDEN()->getValue();
      $this->setId($id,true);
      if ($value!=null){
        $this->value = $value;
      }
  }

  public function render($twig){
    $template = $twig->load('Element/plain-input.html');
    return $template->render(parent::prepare());
  }
}
?>
