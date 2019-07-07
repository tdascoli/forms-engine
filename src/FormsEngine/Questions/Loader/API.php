<?php
namespace FormsEngine\Questions\Loader;

class API implements Load {

  private $config;

  public function __construct($config){
    $this->config = $config;
  }

  public function load(){
    $serializedString='';
    if (isset($_GET['form'])){
      $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://{$_SERVER['HTTP_HOST']}/api/forms/{$_GET['form']}";

      $response = \Httpful\Request::get($url)
          ->expectsJson()
          ->send();
      $serializedString = json_encode($response->body);
    }
    return $serializedString;
  }

}
?>
