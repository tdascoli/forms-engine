<?php
namespace FormsEngine\Answers\Persistence;

abstract class Persistence {

  public function persist($data){
    CSV::persist($data);
  }
}
?>
