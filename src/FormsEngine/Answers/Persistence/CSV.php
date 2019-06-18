<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Reader;
use \League\Csv\Writer;
use FormsEngine\Config;

class CSV extends Persistence {

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
    $hasHeaders = false;
    if (\file_exists($file)){
      $reader = Reader::createFromPath($file, 'r');
      $hasHeaders = (count($reader)>0);
    }
    return array('fileName' => $file, 'hasHeaders' => $hasHeaders);
  }
}
?>
