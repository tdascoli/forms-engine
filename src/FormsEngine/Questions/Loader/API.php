<?php
namespace FormsEngine\Questions\Loader;

class API implements Load {

  private $config;

  public function __construct($config){
    $this->config = $config;
  }

  public function load(){
    $serializedString='';
    if (isset($_GET[$this->config->get])){
      $url = $this->config->url.$_GET[$this->config->get];
      $response = \Httpful\Request::get($url)
          ->expectsJson()
          ->send();

      if ($response->body!=NULL){
          $serializedString = json_encode($response->body);
      }
      else {
        $serializedString='';
      }
    }
    return $serializedString;
  }

}
?>
