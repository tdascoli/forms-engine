<?php
namespace FormsEngine\Translations;

use FormsEngine\DynConfig;

class Translations {

  private $i18n;

  public function __construct(){
    $this->i18n = new \i18n();
    $this->init();
  }

  private function init(){
    $this->i18n->setFilePath(DynConfig::getInstance()->get('langDir')."/lang_{LANGUAGE}.json");
    $this->i18n->init();
  }
}
?>
