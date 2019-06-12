<?php
namespace FormsEngine\Questions;

/**
 * Class AbstractField
 * @package FormsEngine\Questions
 */
abstract class AbstractField {
  /** @var string */
  public $id;

  /** @var string */
  public $label;

  /** @var FieldType */
  public $type;

  /** @var string */
  public $placeholder;

  /** @var Validation */
  public $validation;

  /** @var string */
  public $helptext;

  /** @var string */
  public $value;

  /** @var boolean */
  public $required;

  /** @var array */
  public $inputmask;

  /** @var array */
  public $style;

  /** @var boolean */
  public $readonly;

  /** @var boolean */
  public $disabled;

  /** @var Privacy */
  public $privacy;

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
