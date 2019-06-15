<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Paragraph extends ElementParagraph {

  public function __construct($title=null, $description=null) {
      parent::__construct($title, $description);
      $this->type = Type::PARAGRAPH()->getValue();
  }

  public function render($twig){
    $template = $twig->load('paragraph.html');
    return $template->render(parent::prepare());
  }
}
?>
