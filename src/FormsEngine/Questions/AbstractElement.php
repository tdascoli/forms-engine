<?php
namespace FormsEngine\Questions;

/**
 * Class AbstractElement
 * @package FormsEngine\Questions
 */
abstract class AbstractElement {
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

  /**
   * @return class
   */
  public static function deserialize($object){
    foreach ($object as $key => $value) {
      self::toObjectVar($key, $value);
    }

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
