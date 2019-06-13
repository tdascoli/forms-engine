<?php
namespace FormsEngine\Answers\Persistence;

abstract class CompleteHandler extends Persistence {

  private $persistenceType;
  private $hasSubmitted;

  public function save(){

    $this->persistenceType = PersistenceType::CSV();

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      $this->persist($_POST, $this->persistenceType->getValue());
      $this->hasSubmitted = true;
    }
    $this->hasSubmitted = false;
  }

  private function wrapper(){
    // todo
  }
}
?>
