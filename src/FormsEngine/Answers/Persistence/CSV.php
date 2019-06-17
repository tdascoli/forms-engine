<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Writer;

class CSV {

  // todo add titles!! config!
  // todo check if static is apropriated

  public static function persist($data){
    try {
        $writer = Writer::createFromPath('file.csv', 'a+');
        // todo check if file was created then add headers
        if (1 > 1){
          $writer->insertOne(\array_keys($data));
        }
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords();
    }
  }
}
?>
