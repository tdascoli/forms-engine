<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Title extends Paragraph {

  public function __construct($title, $description=null) {
      parent::__construct($title, $description);
      $this->type = Type::TITLE()->getValue();
  }

  public function render($twig){
    $template = $twig->load('title.html');
    return $template->render(parent::prepare());
  }
}
?>
