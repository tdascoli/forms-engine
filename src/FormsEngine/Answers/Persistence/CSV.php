<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Writer;

class CSV {

  // todo add titles!! config!

  public static function persist($data){
    try {
        $writer = Writer::createFromPath('file.csv', 'a+');
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords();
    }
  }
}
?>
