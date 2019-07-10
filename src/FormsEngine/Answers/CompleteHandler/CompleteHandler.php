<?php
namespace FormsEngine\Answers\CompleteHandler;

use FormsEngine\Config;
use FormsEngine\Answers\Persistence\PersistenceType;

class CompleteHandler extends PersistenceTypeHandler {

  /** @var string */
  private $persistenceType;

  public function save(){
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
      if (isset($_SESSION['hasSubmitted']) && !$_SESSION['hasSubmitted']){
        $this->persist($this->prepare($_POST), $this->getPersistenceType());
        $_SESSION['hasSubmitted'] = true;
      }
    }
    else {
      $_SESSION['hasSubmitted'] = false;
    }
  }

  private function persist($data, $type){
    if (PersistenceType::isValid($type)){
      $class = 'FormsEngine\Answers\Persistence\\'.$type;
      $class::persist(Config::getInstance()->get('form','name'), $data);
    }
    else if (\class_exists($type)){
      $class = $type;
      $class::persist($data);
    }
  }

  private function prepare($post){
    $data = array();
    if (isset($post['form-keys'])){
      $keys = \json_decode(\base64_decode($post['form-keys']));
      foreach ($keys as $key) {
        $data[$key] = '';
        if (isset($post[$key])){
          $data[$key] = $post[$key];
        }
      }
    }
    \var_dump($data);
    return $data;
  }

  public function isSubmitted(){
    return $_SESSION['hasSubmitted'];
  }
}
?>
