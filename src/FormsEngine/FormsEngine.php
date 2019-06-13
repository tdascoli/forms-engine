<?php
namespace FormsEngine;

use FormsEngine\Renderer\Renderer as Renderer;
use FormsEngine\Answers\Answers as Answers;

class FormsEngine {
  private $renderer;
  private $answers;

  public function __construct(){
    $this->renderer = new Renderer();
    $this->answers = new Answers();
  }

  public function renderer(){
    return $this->renderer;
  }

  public function answers(){
    return $this->answers;
  }
}
?>
