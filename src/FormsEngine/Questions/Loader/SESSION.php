<?php
namespace FormsEngine\Questions\Loader;

class SESSION implements Load {

  private $session;

  public function __construct($session){
    $this->session = $session['session'];
  }

  public function load(){
    $serializedString='';
    if (isset($_SESSION[$this->session])){
      $serializedString = $_SESSION[$this->session];
    }
    return $serializedString;
  }

}
?>
