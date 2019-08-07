<?php
namespace FormsEngine\Answers;

use FormsEngine\Config;
use FormsEngine\Answers\Persistence\PersistenceType;
use FormsEngine\Answers\CompleteHandler\CompleteHandler as CompleteHandler;

class Answers extends CompleteHandler {

  private $twig;

  public function __construct(){
    $loader = new \Twig\Loader\FilesystemLoader(Config::getInstance()->get('templateDir'));
    $this->twig = new \Twig\Environment($loader);

    if (\session_status() != PHP_SESSION_ACTIVE) {
      \session_start();
    }
  }

  public function list(){
    $type = Config::getInstance()->get('persistence','type');
    $name = Config::getInstance()->get('form','name');
    $data = \json_decode($this->load($name, $type));

    if ($data!=NULL){
      $keys = array_keys(\get_object_vars($data[0]));
      var_dump($data);
    }
  }

  private function load($name, $type){
    if (PersistenceType::isValid($type)){
        $class = 'FormsEngine\Answers\Persistence\\'.$type;
        return $class::load($name);
    }
    else if (\class_exists($type)){
        $class = $type;
        return $class::load($name);
    }
    return NULL;
  }

  public function check(){
    return $this->isSubmitted();
  }
}
?>
