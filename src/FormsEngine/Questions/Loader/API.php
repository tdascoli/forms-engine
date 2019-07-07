<?php
namespace FormsEngine\Questions\Loader;

class API implements Load {

  private $config;

  public function __construct($config){
    $this->config = $config;
  }

  public function load(){
    $serializedString='';
    if (isset($_GET[$this->config->get)){
      $response = \Httpful\Request::get($this->config->url)
          ->expectsJson()
          ->send();
      $serializedString = json_encode($response->body);
    }
    return $serializedString;
  }

}
?>
