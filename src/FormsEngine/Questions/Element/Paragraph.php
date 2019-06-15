<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Paragraph extends Element {

  public $title;
  public $description;

  public function __construct($title=null,$description=null) {
    $this->type = Type::PARAGRAPH()->getValue();
    if ($title!=null){
        $this->title = $title;
    }
    if ($description!=null){
        $this->description = $description;
    }
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['title'] = $this->title;
    $vars['description'] = $this->description;
    return $vars;
  }

  public function render($twig){
    $template = $twig->load('paragraph.html');
    return $template->render(parent::prepare());
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new Paragraph($object->title);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    return $class;
  }
}
?>
