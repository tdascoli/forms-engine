<?php
namespace FormsEngine\Answers\Collection;

use Psr\Container\ContainerInterface;
use FormsEngine\Answers\Persistence\PersistenceType;

class Collection {

  protected $container;

  // constructor receives container instance
  public function __construct(ContainerInterface $container) {
     $this->container = $container;
  }

  public function load($request, $response, $args) {
    $formId = $args['formId'];
    $type = PersistenceType::CSV()->getValue();
    if (isset($args['type'])){
      $type = $args['type'];
    }

    $data = $this->collect($formId, $type);

    if (!empty($data)){
      $newResponse = $response->withJson(json_decode($data));
    }
    else {
      $newResponse = $response->withStatus(404);
    }
    return $newResponse;
  }

  private function collect($name, $type){
    $data = '';
    if (PersistenceType::isValid($type)){
        $class = 'FormsEngine\Answers\Persistence\\'.$type;
        $data = $class::load($name);
    }
    else if (\class_exists($type)){
        $class = $type;
        $data = $class::load($name);
    }
    return $data;
  }

}
?>
