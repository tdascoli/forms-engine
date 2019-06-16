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
  public $name;

  /** @var string */
  public $label;

  /** @var FieldType */
  public $type;

  /** @var string */
  public $placeholder;

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

  /** @var array */
  public $attributes;

  /** @var boolean */
  public $readonly;

  /** @var boolean */
  public $disabled;

  /**
   * @return array
   */
  public function serialize() {
      return \get_object_vars($this);
  }

  public static function deserialize($object){
        echo 'implement method';
  }

  public function toObjectVar($key, $value, $class = null){
    if ($class == null){
        $class = $this;
    }
    if (\property_exists($class, $key)){
      $class->{$key} = $value;
    }
  }
}
?>
