<?php
namespace FormsEngine\Answers\Persistence;

use \League\Csv\Writer;

// todo JSON
class JSON extends Persistence {

  public static function persist($data){
    try {
        $writer = Writer::createFromPath('json.csv', 'a+');
        $writer->insertOne($data);
    } catch (CannotInsertRecord $e) {
        $e->getRecords(); //returns [1, 2, 3]
    }
  }
}
?>
