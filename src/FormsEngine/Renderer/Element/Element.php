<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\AbstractElement;

abstract class Element extends AbstractElement {

  public function __construct($label,$placeholderLabel=false) {
      $this->setId($label);
      if (!$placeholderLabel){
          $this->label = $label;
      }
      else {
          $this->placeholder = $label;
      }
  }

  public function prepare(){
    return parent::serialize();
  }

  private function setId($id){
    $this->id = $this::camelCase($id);
  }

  private static function camelCase($str, array $noStrip = []){
    // non-alpha and non-numeric characters become spaces
    $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
    $str = trim($str);
    // uppercase the first character of each word
    $str = ucwords($str);
    $str = str_replace(" ", "", $str);
    $str = lcfirst($str);

    return $str;
  }

  public function required($required = true){
      $this->required = $required;
  }

  public function readonly($readonly = true){
      $this->readonly = $readonly;
  }

  public function disabled($disabled = true){
      $this->disabled = $disabled;
  }

  public function inputmask($mask,$type = 'mask'){
      $this->$inputmask = array('type' => $type, 'mask' => $mask);
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
    $class = new Element($object->label);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    var_dump($class);
    return __CLASS__;
  }

  private function toObjectVar($key, $value){
    //if (!empty($value)){ // todo check if necessary
    if (\property_exists($this, $key)){
      $this->{$key} = $value;
    }
  }
}
?>
