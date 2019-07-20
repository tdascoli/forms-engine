<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Textarea extends Input {

  public function __construct($label,
                              $helptext = null) {
      parent::__construct($label, null, $helptext);
      $this->type = Type::TEXTAREA()->getValue();
  }

  public function render($twig){
    $template = $twig->load('textarea.html');
    return $template->render(parent::prepare());
  }
}
?>
