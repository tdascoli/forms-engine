<?php
session_start();

require __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FormsEngine\Config;
use FormsEngine\Answers\Collection\Collection;
use FormsEngine\Answers\CompleteHandler\ServerCompleteHandler;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// Config
$_SESSION['configFile'] = __DIR__ . '/../config.json';

// ENV
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$app = new Slim\App;

// Basic Auth
$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    "secure" => true,
    "users" => [
        getenv('API_USERNAME') => getenv('API_PASSWORD')
    ]
]));

$app->put('/record/{formId}', ServerCompleteHandler::class . ':save');

$app->get('/record/{formId}[/{type}]', Collection::class . ':load');

$app->run();
?>
