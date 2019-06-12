<?php
namespace FormsEngine\Questions;

/**
 * Class AbstractField
 * @package FormsEngine\Questions
 */
abstract class AbstractField {
  /** @var string */
  private $id;

  /** @var string */
  private $label;

  /** @var FieldType */
  private $type;

  /** @var string */
  private $placeholder;

  /** @var Validation */
  private $validation;

  /** @var string */
  private $helptext;

  /** @var string */
  private $value;

  /** @var boolean */
  private $required;

  /** @var boolean */
  private $hidden;

  /** @var string */
  private $inputmask;

  /** @var Style */
  private $style;

  /** @var boolean */
  private $readonly;

  /** @var boolean */
  private $disabled;

  /** @var Privacy */
  private $privacy;

  /**
   * @return array
   */
  public function toSerializedArray() {
      // todo
      return \get_object_vars($this);
      /*
      return [
          "label" => $this->label
      ];
      */
  }
}
?>
