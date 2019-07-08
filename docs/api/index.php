<?php

require __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FormsEngine\Answers\Collection\Collection;
use FormsEngine\Answers\CompleteHandler\ServerCompleteHandler;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Psr\Container\ContainerInterface;

$app = new \Slim\App;

$app->put('/record/{formId}', ServerCompleteHandler::class . ':save');

$app->get('/record/{formId}[/{type}]', Collection::class . ':load');

$app->run();
?>
