<?php
namespace FormsEngine\Answers\Persistence;

class CompleteHandler extends Persistence {

  /** @var string */
  private $persistenceType;

  /** @var boolean */
  private $hasSubmitted;

  public function save(){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      $this->persist($_POST, $this->getPersistenceType());
      $this->hasSubmitted = true;
    }
    else {
      $this->hasSubmitted = false;
    }
  }

  public function setPersistenceType($type){
    if ($type instanceof PersistenceType){
      $this->persistenceType = $type->getValue();
    }
  }

  private function getPersistenceType(){
    if (!empty($this->persistenceType)){
      return $this->persistenceType;
    }
    return PersistenceType::CSV()->getValue();
  }

  private function wrapper(){
    // todo
  }

  public function isSubmitted(){
    return $this->hasSubmitted;
  }
}
?>
