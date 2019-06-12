<?php
namespace FormsEngine\Renderer;

class RenderConfig {

  public static $templateDir = __DIR__ . '/Templates/';

  // todo check
  public static function updateTemplateDir($dir){
    $self::templadeDir = $dir;
  }
}
?>
