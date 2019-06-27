<?php
namespace Somewhere\Persistence;

use \FormsEngine\Answers\Persistence\Persistence;

class DBPersistence implements Persistence {

  public static function persist($data){
    echo 'persist data: '.$data;
  }
}
?>
