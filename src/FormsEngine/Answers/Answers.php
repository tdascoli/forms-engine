<?php
namespace FormsEngine\Answers;

use FormsEngine\Answers\Persistence\CompleteHandler as CompleteHandler;

class Answers extends CompleteHandler {

  public function __construct(){
    \session_start();
  }

  public function check(){
    return $this->isSubmitted();
  }
}
?>
