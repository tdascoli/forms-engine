<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Input extends Element {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label);
      $this->label = $label;
      if ($placeholder!=null){
        $this->placeholder = $placeholder;
      }
      if ($helptext!=null){
        $this->helptext = $helptext;
      }
  }

  public function render($twig){
    $template = $twig->load('input.html');
    return $template->render(parent::prepare());
  }
}
?>
