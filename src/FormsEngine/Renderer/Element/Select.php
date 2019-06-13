<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Select extends Element {

  private $options;

  public function __construct($label,
                              $options,
                              $nullable = false,
                              $helptext = null) {
      parent::__construct($label);
      $this->type = Type::SELECT()->getValue();
      if ($options instanceof Option){
        $this->options = $options->all();
      }
      if ($nullable){
        \array_unshift($this->options, Option::create('- bitte wählen -',''));
      }
      if ($helptext!=null){
        $this->helptext = $helptext;
      }
  }

  public function render($twig){
    $template = $twig->load('select.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['options'] = $this->options;
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
    $class = new Select($object->label, $object->options);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value, $class);
    }
    return $class;
  }
}
?>
