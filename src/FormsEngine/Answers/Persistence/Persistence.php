<?php
namespace FormsEngine\Answers\Persistence;

abstract class Persistence {

  public function persist($data, $type){
    if (PersistenceType::isValid($type)){
      $class = 'FormsEngine\Answers\Persistence\\'.$type;
      $class::persist($data);
    }
  }
}
?>
