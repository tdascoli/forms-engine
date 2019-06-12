<?php
namespace FormsEngine\Renderer\Element;

abstract class Serialization {

  /**
   * @return array
   */
  public function serialize() {
      return \get_object_vars($this);
  }

  public function deserialize($string){
    // todo

  }

  private function toObjectVar($var, $value){
    if (!empty($value)){
      $this->$var = $value;
    }
  }
}
?>
