<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Typeahead extends Input {

  public $options;
  public $script;

  public function __construct($label,
                              $options,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = Type::TYPEAHEAD()->getValue();
      if (\is_array($options)){
        $this->options = $options;
      }
      $this->prepareScript();
  }

  public function render($twig){
    $template = $twig->load('typeahead.html');
    return $template->render($this->prepare());
  }

  public function script(){
    return $this->script;
  }

  public function prepare(){
    $vars = parent::prepare();
    $vars['options'] = $this->options;
    return $vars;
  }

  private function prepareScript(){
    $this->script = 'var '.$this->id.'Data = '.json_encode($this->options).';'.
                    '$("#'.$this->id.'").typeahead({ source:'.$this->id.'Data });';
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
    $class = new Typeahead($object->label, $options::deserialize($object->options));
    foreach ($object as $key => $value) {
        if ($key!="options"){
            $class->toObjectVar($key, $value, $class);
        }
    }
    return $class;
  }
}
?>
