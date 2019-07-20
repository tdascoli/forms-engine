<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Typeahead extends Text {

  public $options;
  public $script;
  private $config;

  public function __construct($label,
                              $options,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label, $placeholder, $helptext);
      $this->type = Type::TYPEAHEAD()->getValue();
      $this->options = $options;
      $this->config = array('minLength' => '1');
      //$this->config['selector']=array('container' => 'form-group');
      $this->prepareScript();
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
    if (\is_array($this->options)){
      $this->config['source'] = $this->options;
    }
    else if ($this->options instanceof Option){
      $this->config['source'] = $this->options->all();
      $this->config['display']='label';
    }
    $this->script = '$("#'.$this->id.'").typeahead('.\json_encode($this->config, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).');'."\n";
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
