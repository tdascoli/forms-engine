<?php
namespace FormsEngine\Answers\Persistence;

abstract class CompleteHandler extends Persistence {

  public function save(){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      $this->persist($_POST);
    }
  }
}
?>
