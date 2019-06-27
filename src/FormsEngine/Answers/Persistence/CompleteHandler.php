<?php
namespace FormsEngine\Answers\Persistence;

class CompleteHandler {

  /** @var string */
  private $persistenceType;

  // todo when pagination not last, not persist save values in session
  public function save($elementKeys = null){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      //if (!$_SESSION['hasSubmitted']){
        var_dump($this->getPersistenceType());
        $this->persist($_POST, $this->getPersistenceType());
        $_SESSION['hasSubmitted'] = true;
      //}
    }
    else {
      $_SESSION['hasSubmitted'] = false;
    }
  }

  private function persist($data, $type){
      var_dump(\class_exists($type));
    if (PersistenceType::isValid($type)){
        echo 'valid persistenceType';
      $class = 'FormsEngine\Answers\Persistence\\'.$type;
      $class::persist($data);
    }
    else if (\class_exists($type)){
        echo 'class_exists persistenceType';
      $class = $type;
      $class::persist($data);
    }
  }

  public function setPersistenceType($type){
      var_dump($type);
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
