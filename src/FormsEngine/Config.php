<?php
namespace FormsEngine;

class Config {

  /** @var string */
  public static $templateDir = __DIR__ . '/Templates/';

  // todo change to ajax
  /** @var string */
  public static $method = "post";

  /** @var string */
  public static $name = "defaultForm";

  /** @var boolean */
  public static $messageAfterSubmit = true;

  /** @var boolean */
  public static $createAnother = true;

  // todo check
  public static function updateTemplateDir($dir){
    $self::$templateDir = $dir;
  }

  // todo check
  public static function asPost(){
    $self::$method = Method::POST()->getValue();
  }

  // todo check
  public static function asAjax(){
    $self::$method = Method::AJAX()->getValue();
  }

  // todo check
  public static function setName($formName){
    $self::$name = $formName;
  }

  // todo check
  public static function updateMessageAfterSubmit($message){
    $self::$messageAfterSubmit = $message;
  }

  // todo check
  public static function setCreateAnother($another){
    $self::$createAnother = $another;
  }
}
?>
