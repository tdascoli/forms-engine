<?php
namespace FormsEngine\Answers\CompleteHandler;

use FormsEngine\Config;
use FormsEngine\Answers\Persistence\PersistenceType;

abstract class PersistenceTypeHandler {

  /** @var string */
  private $persistenceType;

  public function setPersistenceType($type){
    if ($type instanceof PersistenceType){
      $this->persistenceType = $type->getValue();
    }
    else if (\class_exists($type)){
      $this->persistenceType = $type;
    }
  }

  public function getPersistenceType(){
    if (!empty($this->persistenceType)){
      return $this->persistenceType;
    }
    return PersistenceType::CSV()->getValue();
  }

}
?>
