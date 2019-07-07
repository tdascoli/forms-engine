<?php
namespace FormsEngine\Questions\Loader;

class Loader implements Load {

  private $type;
  private $config;

  public function __construct($type, $config = null){
    if (LoaderType::isValid($type)){
      $this->type = $type;
    }
    if ($config != null){
      $this->config = $config;
    }
  }

  public function load(){
    $class = 'FormsEngine\Questions\Loader\\'.$this->type;
    $loader = new $class($this->config);
    $serializedString=$loader->load();
    return $serializedString;
  }

}
?>
