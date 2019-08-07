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

  // todo: param name?
  public function list($name = null){
    $type = Config::getInstance()->get('persistence','type');
    if ($name==null){
      $name = Config::getInstance()->get('form','name');
    }
    $data = \json_decode($this->load($name, $type), true);

    if ($data!=NULL){
      $keys = array_keys($data[0]);
      $params = array('keys' => $keys, 'data' => $data, 'name' => $name);

      echo $this->twig->render('Answers/table.html',$params);
    }
    else {
      echo $this->twig->render('message.html',['message'=>\L::message_noData]);
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
