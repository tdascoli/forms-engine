<?php
namespace FormsEngine\Questions\Element;

abstract class ElementParagraph extends Element {

  public $title;
  public $description;

  public function __construct($title=null,$description=null) {
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

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new ElementParagraph($object->title);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    return $class;
  }
}
?>
