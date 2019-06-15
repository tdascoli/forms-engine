<?php
namespace FormsEngine;

use FormsEngine\Questions\Renderer as Renderer;
use FormsEngine\Answers\Answers as Answers;

class FormsEngine {
  private $renderer;
  private $answers;

  public function __construct($autosave = true){
    $this->renderer = new Renderer();
    $this->answers = new Answers();
    if ($autosave){
      $this->answers->save();
    }
  }

  public function renderer(){
    return $this->renderer;
  }

  public function answers(){
    return $this->answers;
  }
}
?>
