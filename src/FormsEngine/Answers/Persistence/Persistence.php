<?php
namespace FormsEngine\Answers\Persistence;

abstract class Persistence {

  public function persist($data, $type){
    if (PersistenceType::isValid($type)){
      // todo $type::persist($data);
      CSV::persist($data);
    }
  }
}
?>
