<?php
namespace FormsEngine\Server;

use FormsEngine\Answers\Answers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// todo check if own repo isnt better

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->put('/form/{formId}', \ServerCompleteHandler::class . ':persist');

$app->put('/form/{formId}',  function (Request $request, Response $response, array $args) {
    $formId = $args['formId'];
    $body = $request->getBody();
    $form = json_decode($body);

/*

http://www.slimframework.com/docs/v3/objects/router.html#container-resolution

    $handle = fopen(__DIR__ .'/../mock/forms/'.$formId.'.json','w+');
    fwrite($handle, \json_encode($form));
    fclose($handle);
*/

    $response->getBody()->write('ok');
    return $response;
});
$app->run();


class ServerCompleteHandler
{
    protected $view;

    public function __construct(\Slim\Views\Twig $view) {
        $this->view = $view;
    }
    public function persist($request, $response, $args) {
      $formId = $args['formId'];
      $body = $request->getBody();
      $form = json_decode($body);

      // your code here
      // use $this->view to render the HTML
      $response->getBody()->write('ok');
      return $response;
    }
}
?>
