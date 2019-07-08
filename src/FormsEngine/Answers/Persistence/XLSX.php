<?php
namespace FormsEngine\Answers\Persistence;

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Reader;
use \PhpOffice\PhpSpreadsheet\Writer;
use FormsEngine\Config;

class XLSX implements Persistence {

  public static function persist($name, $data){
    $file = $name.'.xlsx';
    $path = Config::$formsDir;
    $pathFile = $path.$file;

    if (\file_exists($pathFile)){
      $reader = new Reader\Xlsx($pathFile);
      $spreadsheet = $reader->load($pathFile);
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
    $writer->save($pathFile);
  }

  public static function load($name){
    $file = $name.'.xlsx';
    $path = Config::$formsDir;
    $pathFile = $path.$file;

    $records = '';

    if (\file_exists($pathFile)){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      $spreadsheet = $reader->load($pathFile);
      $worksheet = $spreadsheet->getActiveSheet();
      $records = $worksheet->toArray();
    }
    return $records;
  }
}
?>
