<?php
namespace FormsEngine\Renderer\Element;

abstract class Element {

  /** @var string */
  public $id;

  /** @var string */
  private $label;

  /** @var fieldType */
  private $type;

  /** @var string */
  private $placeholder;

  /** @var string */
  private $helptext;

  /** @var string */
  private $value;

  public function __construct($id) {
    $this->setId($id);
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
