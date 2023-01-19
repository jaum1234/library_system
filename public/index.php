<?php 

use Library\Helpers\Request;
use Library\Helpers\Response;

require_once __DIR__ . "/../vendor/autoload.php";

header("Content-Type: application/json");

$request = new Request();
$response = new Response();

$routes = require_once __DIR__ . "/../routes/routes.php";

$resource = $request->resource();
$method = $request->method();
$id = $request->id();

$parameter = $id != 0 ? "/$id" : "";

$action = $routes["$method|/$resource" . $parameter];

if ($action === null) {
    return $response->status(404);
}

$controllerName = $action[0];
$controllerMethod = $action[1];

$controller = new $controllerName();
echo $controller->$controllerMethod($request, $response);

?>