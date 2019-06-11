<?php
namespace FormsEngine\Renderer;

class Config {

  public static $templateDir = __DIR__ . '/Templates/';

  // todo check
  public static function updateTemplateDir($dir){
    $self::templadeDir = $dir;
  }
}
?>
