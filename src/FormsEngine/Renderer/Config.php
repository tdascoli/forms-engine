<?php
namespace FormsEngine\Renderer;

class Config {

  public static $templateDir = __DIR__ . '/Templates/';

  public static function updateTemplateDir($dir){
    $this->templadeDir = $dir;
  }
}
?>
