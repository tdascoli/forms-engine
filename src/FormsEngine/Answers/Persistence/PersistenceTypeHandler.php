<?php
namespace FormsEngine\Answers\Persistence;

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

  private function getPersistenceType(){
    if (!empty($this->persistenceType)){
      return $this->persistenceType;
    }
    return PersistenceType::CSV()->getValue();
  }

}
?>
