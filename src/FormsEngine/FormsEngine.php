<?php
namespace FormsEngine;

use FormsEngine\Answers\Answers;
use FormsEngine\Questions\Renderer;
use FormsEngine\Translations\Translations;

class FormsEngine {

  private $answers;
  private $renderer;
  private $translations;

  public function __construct($config = null){
    $this->answers = new Answers();
    $this->renderer = new Renderer();
    $this->translations = new Translations();

    $this->answers->save();

    if ($config!=null && \is_array($config)){
       $_SESSION[$config['key']]=$config['value'];
     }
  }

  public function answers(){
    return $this->answers;
  }

  public function renderer(){
    return $this->renderer;
  }

  public function translations(){
    return $this->translations;
  }
}
?>
