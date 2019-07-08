<?php
namespace Somewhere\Persistence;

use \FormsEngine\Answers\Persistence\Persistence;

class TestPersistence implements Persistence {

  public static function persist($name, $data){
    echo 'Insert Data into '.$name.': '.\implode(',',$data);
  }

  public static function load($name){
      echo 'Load Data from '.$name;
  }
}
?>
