<?php
namespace FormsEngine\Answers\Persistence;

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Reader;
use \PhpOffice\PhpSpreadsheet\Writer;
use FormsEngine\Config;

class XLSX implements Persistence {

  public static function persist($data){
    $file = Config::$name.'.xlsx';

    if (\file_exists($file)){
      $reader = new Reader\Xlsx($file);
      $spreadsheet = $reader->load($file);
      $sheet = $spreadsheet->getActiveSheet();
    }
    else {
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->fromArray(\array_keys($data), NULL, 'A1');
    }

    $cell = $sheet->getHighestDataRow();
    $cell++;
    $sheet->fromArray($data, NULL, 'A'.$cell);

    $writer = new Writer\Xlsx($spreadsheet);
    $writer->save($file);
  }
}
?>
