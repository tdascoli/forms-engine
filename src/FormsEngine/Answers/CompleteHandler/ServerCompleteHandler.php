<?php
namespace FormsEngine\Answers\CompleteHandler;

use FormsEngine\Config;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use FormsEngine\Answers\Persistence\PersistenceType;

class ServerCompleteHandler extends PersistenceTypeHandler {
    protected $container;

    public function __construct(ContainerInterface $container) {
       $this->container = $container;
    }

    public function save($request, $response, $args) {
      $formId = $args['formId'];
      $body = $request->getBody();
      $form = json_decode($body);
      $type = Config::getInstance()->get('persistence','type');
      $this->persist($formId, (array) $form, $type);
      // todo error!!!
      $response->withStatus(404);
      return $response;
    }

    private function persist($name, $data, $type){
        if (PersistenceType::isValid($type)){
            $class = 'FormsEngine\Answers\Persistence\\'.$type;
            $class::persist($name, $data);
        }
        else if (\class_exists($type)){
            $class = $type;
            $class::persist($name, $data);
        }
    }
}
?>
