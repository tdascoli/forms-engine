<?php
namespace FormsEngine\Answers\Persistence;

interface Persistence {

  public static function persist($name, $data);

  public static function load($name);

}
?>
