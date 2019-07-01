<?php
namespace FormsEngine\Answers\Persistence;

class CompleteHandler {

  /** @var string */
  private $persistenceType;

  public function save($elementKeys = null){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      if (!$_SESSION['hasSubmitted']){
        $this->persist($_POST, $this->getPersistenceType());
        $_SESSION['hasSubmitted'] = true;
      }
    }
    else {
      $_SESSION['hasSubmitted'] = false;
    }
  }

  private function persist($data, $type){
    if (PersistenceType::isValid($type)){
      $class = 'FormsEngine\Answers\Persistence\\'.$type;
      $class::persist($data);
    }
    else if (\class_exists($type)){
      $class = $type;
      $class::persist($data);
    }
  }

  public function setPersistenceType($type){
    if ($type instanceof PersistenceType){
      $this->persistenceType = $type->getValue();
    }
    else if (\class_exists($type)){
      $this->persistenceType = $type;
    }
  }

  private function getPersistenceType(){
    if (!empty($this->persistenceType)){
      return $this->persistenceType;
    }
    return PersistenceType::CSV()->getValue();
  }

  public function isSubmitted(){
    return $_SESSION['hasSubmitted'];
  }
}
?>
