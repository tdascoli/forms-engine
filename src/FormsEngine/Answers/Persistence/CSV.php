<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Reader;
use \League\Csv\Writer;
use FormsEngine\Config;

class CSV implements Persistence {

  public static function persist($name, $data){
    try {
        $file = self::prepareFile($name);
        $writer = Writer::createFromPath($file['fileName'], 'a+');
        if (!$file['hasHeaders']){
          $writer->insertOne(\array_keys($data));
        }
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords();
    }
  }

  public static function load($name){
    $file = self::prepareFile($name);

    $records = '';

    if (\file_exists($file['fileName'])){
      $reader = Reader::createFromPath($file['fileName'], 'r');
      $reader->setHeaderOffset(0);
      $records = \json_encode($reader, JSON_PRETTY_PRINT);
    }
    return $records;
  }

  private static function prepareFile($name){
    $file = $name.'.csv';
    $path = Config::getInstance()->get('form','dir');
    $pathFile = $path.$file;

    $hasHeaders = false;
    if (\file_exists($pathFile)){
      $reader = Reader::createFromPath($pathFile, 'r');
      $hasHeaders = (count($reader)>0);
    }
    return array('fileName' => $pathFile, 'hasHeaders' => $hasHeaders);
  }
}
?>
