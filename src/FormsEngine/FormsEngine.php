<?php
namespace FormsEngine;

use FormsEngine\Answers\Answers;
use FormsEngine\Questions\Renderer;
use FormsEngine\Translations\Translations;
use FormsEngine\Answers\Persistence\PersistenceType;

class FormsEngine {

  private $answers;
  private $renderer;
  private $translations;

  public function __construct(){
    $this->answers = new Answers();
    $this->renderer = new Renderer();
    $this->translations = new Translations();

    $this->answers->setPersistenceType(
                    new PersistenceType(
                        Config::getInstance()->get('persistence','type')));
    $this->answers->save();
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
