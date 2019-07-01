<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;
use FormsEngine\Translations\Translations;

class CheckboxGroup extends Element {

  private $options;

  public function __construct($label, $options) {
    parent::__construct($label);
    $this->type = Type::CHECKBOX_GROUP()->getValue();
    $this->options = $options;
  }


  public function render($twig){
    $template = $twig->load('checkbox-group.html');
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
     $options = new Option();
     $class = new CheckboxGroup($object->label, $options::deserialize($object->options));
     foreach ($object as $key => $value) {
         if ($key!="options"){
             $class->toObjectVar($key, $value, $class);
         }
     }
     return $class;
   }
}
?>
