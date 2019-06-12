<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\AbstractField;

abstract class Element extends AbstractField {

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
    return \get_object_vars($this);
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
}
?>
