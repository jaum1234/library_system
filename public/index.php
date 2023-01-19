<?php 

use Library\Helpers\Request;
use Library\Helpers\Response;

require_once __DIR__ . "/../vendor/autoload.php";

header("Content-Type: application/json");

$request = new Request();
$response = new Response();

$routes = require_once __DIR__ . "/../routes/routes.php";

$resources = $request->resources();
$method = $request->method();
$ids = $request->ids();

$firstResource = $resources[0];
$secondResource = $resources[1] != null ? "/$resources[1]" : "";

$firstParameter = $ids[0] != 0 ? "/$ids[0]" : "";
$secondParameter = $ids[1] != 0 ? "/$ids[1]" : "";

$action = $routes["$method|/$resources[0]" . $firstParameter . $secondResource . $secondParameter];

if ($action === null) {
    return $response->status(404);
}

$controllerName = $action[0];
$controllerMethod = $action[1];

$controller = new $controllerName();

echo $controller->$controllerMethod($request, $response);

?>