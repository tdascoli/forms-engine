<?php
namespace FormsEngine\Questions\Loader;

class COOKIE implements Load {

  private $cookie;

  public function __construct($cookie){
    $this->cookie = $cookie;
  }

  public function load(){
    $serializedString='';

    if (isset($_COOKIE[$this->cookie])){
      $serializedString = $_COOKIE[$this->cookie];
    }
    return $serializedString;
  }

}
?>
