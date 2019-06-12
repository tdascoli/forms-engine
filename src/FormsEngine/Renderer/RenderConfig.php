<?php
namespace FormsEngine\Renderer;

class RenderConfig {

  public static $templateDir = __DIR__ . '/Templates/';

  public $method; // enum: post, get, ajax
  public $name; // string/optional

  // todo check
  public static function updateTemplateDir($dir){
    $self::$templateDir = $dir;
  }
}
?>
