<?php 

use Library\Helpers\EntityManagerCreator;
use Library\Helpers\Request;
use Library\Helpers\Response;

require_once __DIR__ . "/../vendor/autoload.php";

header("Content-Type: application/json");

$request = new Request();
$response = new Response();

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

$routes = require_once __DIR__ . "/../routes/routes.php";

$action = $routes["$method|$uri"];

$response = new Response();
$request = new Request();

if ($action === null) {
    return $response->status(404);
}

$controllerName = $action[0];
$controllerMethod = $action[1];

$controller = new $controllerName();
echo $controller->$controllerMethod($request, $response);

?>