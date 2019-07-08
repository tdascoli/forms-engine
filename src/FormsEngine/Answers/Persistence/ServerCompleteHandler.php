<?php
namespace FormsEngine\Answers\Persistence;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

// todo check if own repo isnt better

class ServerCompleteHandler extends PersistenceTypeHandler
{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
       $this->container = $container;
    }

    public function save($request, $response, $args) {
      $formId = $args['formId'];
      $body = $request->getBody();
      $form = json_decode($body);

      // todo object to array
      $this->persist((array) $form, $this->getPersistenceType());

      $response->getBody()->write('ok');
      return $response;
    }

    private function persist($data, $type){
        if (PersistenceType::isValid($type)){
            $class = 'FormsEngine\Answers\Persistence\\'.$type;
            $class::persist($data);
        }
        else if (\class_exists($type)){
            $class = $type;
            $class::persist($data);
        }
    }
}
?>
