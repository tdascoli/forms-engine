<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\FieldType;

class Text extends Element {

  public function __construct(
                            $label,
                            $placeholder = null,
                            $helptext = null) {
      parent::__construct($label);
      $this->type = FieldType::TEXT();
      $this->label = $label;
      if ($placeholder!=null){
        $this->placeholder = $placeholder;
      }
      if ($helptext!=null){
        $this->helptext = $helptext;
      }
  }

  public function render($twig){
    $template = $twig->load('text.html');
    return $template->render(parent::prepare());
  }
}
?>
