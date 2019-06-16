<?php
namespace FormsEngine\Questions;

class RenderConfig {

  /** @var string */
  public static $templateDir = __DIR__ . '/Templates/';

  /** @var Method */
  public $method; // enum: post, ajax

  /** @var string */
  public $name;

  /** @var boolean */
  public static $showMessageAfterSubmit;

  /** @var boolean */
  public static $createAnotherCheckbox;

  // todo check
  public static function updateTemplateDir($dir){
    $self::$templateDir = $dir;
  }
}
?>
