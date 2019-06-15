<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\AbstractElement;
use PhpCollection\Map;

abstract class Element extends AbstractElement {

  public function __construct($label,$placeholderLabel=false) {
      $this->setId($label);
      $this->setName($label);
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

  public function script(){
    return null;
  }

  private function setId($id,$isName = false){
    $this->id = $this::camelCase($id);
    if ($isName){
      $this->setName($id);
    }
  }

  private function setName($name){
    $this->name = $this::camelCase($name);
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

  public function addStyle($style){
    if (!\is_array($this->style)){
        $this->style = array();
    }
    \array_push($this->style, $style);
  }

  public function attr($type, $value){
    if (!$this->attributes instanceof Map){
      $this->attributes = new Map();
    }
    $this->attributes->set($type, $value);
  }
}
?>
