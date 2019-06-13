<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Radio extends Element {

  private $name;
  private $checked;

  public function __construct($label, $value, $name, $checked = false) {
      parent::__construct($label);
      $this->type = Type::RADIO()->getValue();
      $this->value = $value;
      $this->name = $name;
      $this->checked = $checked;
  }

  public function render($twig){
    $template = $twig->load('custom-input.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['name'] = $this->name;
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
    $class = new Radio($object->label, $object->value, $object->name);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value, $class);
    }
    return $class;
  }
}
?>
