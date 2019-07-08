<?php
namespace FormsEngine;

class Config {

  /** @var string */
  public static $templateDir = __DIR__ . '/Templates/';

  /** @var string */
  public static $langDir = __DIR__ . '/Translations/';

  /** @var array */
  public static $form = array(
      'dir' => __DIR__ . '/../../docs/forms/',
      'name' => 'defaultForm',
      'method' => 'ajax',
      'messageAfterSubmit' => true,
      'createAnother' => true,
      'addTimestamp' => false);

  /** @var array */
  public static $render = array(
      'load' => 'COOKIE',
      'config' => array('cookie' => 'jsonForm'));

  /** @var array */
  public static $persistence = array(
      'email' => array('emailTo' => 'test@test.test'));


   /* SETTER */
   public static function setTemplateDir($dir){
     self::$templateDir = $dir;
   }

   public static function setLangDir($dir){
     self::$langDir = $dir;
   }

   public static function setMethodPost(){
     self::$method = Method::POST()->getValue();
   }

   public static function setMethodAjax(){
     self::$method = Method::AJAX()->getValue();
   }

   public static function setFormName($formName){
     self::$form['name'] = $formName;
   }

   public static function setMessageAfterSubmit($message){
     self::$form['messageAfterSubmit'] = $message;
   }

   public static function setCreateAnother($another){
     self::$form['createAnother'] = $another;
   }

   public static function setPersistenceEmailTo($email){
     self::$persistence['email']['emailTo'] = $email;
   }
}
?>
