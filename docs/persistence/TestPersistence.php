<?php
namespace Somewhere\Persistence;

use \FormsEngine\Answers\Persistence\Persistence;

class TestPersistence implements Persistence {

  public static function persist($data){
    echo 'Insert Data: '.\implode(',',$data);;
  }
}
?>
