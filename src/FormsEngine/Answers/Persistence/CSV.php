<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Reader;
use \League\Csv\Writer;
use FormsEngine\Config;

class CSV implements Persistence {

  public static function persist($data){
    try {
        $file = self::prepareFile();
        $writer = Writer::createFromPath($file['fileName'], 'a+');
        if (!$file['hasHeaders']){
          $writer->insertOne(\array_keys($data));
        }
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords();
    }
  }

  private static function prepareFile(){
    $file = Config::$name.'.csv';
    $path = Config::$formsDir;
    $pathFile = $path.$file;

    $hasHeaders = false;
    if (\file_exists($pathFile)){
      $reader = Reader::createFromPath($pathFile, 'r');
      $hasHeaders = (count($reader)>0);
    }
    return array('fileName' => $pathFile, 'hasHeaders' => $hasHeaders);
  }

  public static function load($name){
    $file = $name.'.csv';
    $path = Config::$formsDir;
    $pathFile = $path.$file;

    $records = '';

    if (\file_exists($pathFile)){
      $reader = Reader::createFromPath($pathFile, 'r');
      $reader->setHeaderOffset(0);
      $records = json_encode($reader, JSON_PRETTY_PRINT);
    }
    return $records;
  }
}
?>
