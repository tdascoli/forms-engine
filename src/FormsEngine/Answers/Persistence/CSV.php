<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Writer;

class CSV {

  public static function persist($data){
    try {
        $writer = Writer::createFromPath('file.csv', 'a+');
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords(); //returns [1, 2, 3]
    }
  }
}
?>
