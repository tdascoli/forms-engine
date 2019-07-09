<?php
namespace FormsEngine\Answers;

use FormsEngine\Answers\CompleteHandler\CompleteHandler as CompleteHandler;

class Answers extends CompleteHandler {

  public function __construct(){
    if (\session_status() != PHP_SESSION_ACTIVE) {
      \session_start();
    }
  }

  public function check(){
    return $this->isSubmitted();
  }
}
?>
