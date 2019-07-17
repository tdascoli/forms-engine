<?php
namespace FormsEngine\Answers\Persistence;

use FormsEngine\Config;
use FormsEngine\Answers\Persistence\Persistence;
use SleekDB\SleekDB as DB;

class JSONDB implements Persistence {

  public static function persist($name, $data){
    $store = self::prepare($name);
    $id = $store->insert($data);
  }

  public static function load($name){
    $store = self::prepare($name);
    $data = $store->fetch();
    return \json_encode($data, JSON_PRETTY_PRINT);
  }

  private static function prepare($name){
    $path = Config::getInstance()->get('form','dir');
    $store = DB::store($name, $path);
    return $store;
  }
}
?>
