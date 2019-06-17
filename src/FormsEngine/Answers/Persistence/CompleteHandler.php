<?php
namespace FormsEngine\Answers\Persistence;

class CompleteHandler extends Persistence {

  /** @var string */
  private $persistenceType;

  // todo when pagination not last, not persist save values in session
  public function save(){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      if (!$_SESSION['hasSubmitted']){
        // wrap $_POST or whatever with form data (not saving unnecessary data
        // like submit or other)
        $this->persist($_POST, $this->getPersistenceType());
        $_SESSION['hasSubmitted'] = true;
      }
    }
    else {
      $_SESSION['hasSubmitted'] = false;
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
    return $_SESSION['hasSubmitted'];
  }
}
?>
