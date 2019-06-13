<?php
namespace FormsEngine;

use FormsEngine\Renderer\Renderer as Renderer;
use FormsEngine\Answers\Answers as Answers;

class FormsEngine {
  //todo

  public static function renderer(){
    return new Renderer();
  }

  public static function answers(){
    return new Answers();
  }
}
?>
