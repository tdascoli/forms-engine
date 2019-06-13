<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Select extends Element {

  public $options;

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
      $serialization = \get_object_vars($this);
      //$serialization['options'] = $this->options->serialize();
      return $serialization;
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $options = new Option();
    $class = new Select($object->label, $options::deserialize($object->options));
    foreach ($object as $key => $value) {
        if ($key!="options"){
            $class->toObjectVar($key, $value, $class);
        }
    }
    return $class;
  }
}
?>
