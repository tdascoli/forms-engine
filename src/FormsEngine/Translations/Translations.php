<?php
namespace FormsEngine\Translations;

use FormsEngine\Config;

class Translations {

  private $i18n;

  public function __construct(){
    $this->i18n = new \i18n();
    $this->init();
  }

  public function setFilePath($path){
    Config::setLangDir($path);
    $this->init();
  }

  private function init(){
    $this->i18n->setFilePath(Config::$langDir."/lang_{LANGUAGE}.json");
    $this->i18n->init();
  }
}
?>
