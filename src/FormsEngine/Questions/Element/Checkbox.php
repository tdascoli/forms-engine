<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Checkbox extends Element {

  public $checked;

  public function __construct($label, $value, $checked = false) {
      parent::__construct($label);
      $this->type = Type::CHECKBOX()->getValue();
      $this->value = $value;
      $this->checked = $checked;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['checked'] = $this->checked;
    return $vars;
  }

  /**
   * @return array
   */
  public function serialize() {
      return \get_object_vars($this);
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new Checkbox($object->label, $object->value);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value, $class);
    }
    return $class;
  }
}
?>
