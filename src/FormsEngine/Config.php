<?php
namespace FormsEngine;

// refactoring
class Config {

  /** @var string */
  public static $templateDir = __DIR__ . '/Templates/';

  /** @var string */
  public static $langDir = __DIR__ . '/Translations/';

  // todo change to ajax
  /** @var string */
  public static $method = "post";

  /** @var string */
  public static $name = "defaultForm";

  /** @var boolean */
  public static $messageAfterSubmit = true;

  /** @var boolean */
  public static $createAnother = true;

  public static $peristenceEmailTo = 'test@test.test';

  // api, cookie, session -> LoaderType
  /*
  public static $loader = 'COOKIE';
  public static $loaderConfig = array('cookie' => 'jsonForm');
  */
  // URL
  //$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://{$_SERVER['HTTP_HOST']}/api/forms/{$_GET['form']}";
  public static $loader = 'API';
  public static $loaderConfig = array(
    'url' => 'http://localhost:8000/api/forms/',
    'get' => 'form');


  // todo check
  public static function updateTemplateDir($dir){
    self::$templateDir = $dir;
  }

  // todo check
  public static function updateLangDir($dir){
    self::$langDir = $dir;
  }

  // todo check
  public static function asPost(){
    self::$method = Method::POST()->getValue();
  }

  // todo check
  public static function asAjax(){
    self::$method = Method::AJAX()->getValue();
  }

  // todo check
  public static function setName($formName){
    self::$name = $formName;
  }

  // todo check
  public static function updateMessageAfterSubmit($message){
    self::$messageAfterSubmit = $message;
  }

  // todo check
  public static function setCreateAnother($another){
    self::$createAnother = $another;
  }

  // todo check
  public static function setPersistenceEmailTo($email){
    self::$peristenceEmailTo = $email;
  }
}
?>
