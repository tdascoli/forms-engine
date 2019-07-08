<?php
namespace FormsEngine\Answers\Persistence;

interface Persistence {

  public static function persist($data);

  public static function load($name);

}
?>
