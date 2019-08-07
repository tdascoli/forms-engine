<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;
use FormsEngine\Translations\Translations;

class Select extends Element {

  public $options;

  public function __construct($label,
                              $options,
                              $nullable = false,
                              $helptext = null) {
      $i18n = new Translations();

      parent::__construct($label);
      $this->type = Type::SELECT()->getValue();
      if ($options instanceof Option){
        $this->options = $options->all();
      }
      if ($nullable){
        \array_unshift($this->options, Option::create(\L::element_select_default,''));
      }
      if ($helptext!=null){
        $this->helptext = $helptext;
      }
  }

  public function render($twig){
    $template = $twig->load('Element/select.html');
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
