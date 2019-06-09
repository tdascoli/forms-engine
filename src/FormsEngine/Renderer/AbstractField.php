<?php
namespace FormsEngine\Questions;

/**
 * Class AbstractField
 * @package FormsEngine\Questions
 */
abstract class AbstractField {
  /** @var string */
  private $label;

  /** @var fieldType */
  private $type;

  /** @var string */
  private $placeholder;

  /** @var validation */
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

  /** @var style */
  private $style;

  /** @var boolean */
  private $readonly;

  /** @var boolean */
  private $disabled;

  /** @var privacy */
  private $privacy;

  /**
   * @param string $label
   */
  public function __construct(string $label){
      $this->label = $label;
  }

  /**
 * @param string $label
 */
  public function setLabel(string $label){
      $this->label = $label;
  }
  /**
   * @return null|string
   */
  public function getLabel() : ?string {
      return $this->label;

  }

  /**
   * @return array
   */
  public function toSerializedArray() {
      return [
          "label" => $this->getLabel()
      ];
  }
}
?>
