<?php 

use Library\controllers\BooksController;
use Library\helper\EntityManagerCreator;

require_once __DIR__ . "/../vendor/autoload.php";

header("Content-Type: application/json");

echo BooksController::list();

// $requestMethod = $_SERVER["REQUEST_METHOD"];
// $requestUri = $_SERVER["REQUEST_URI"];

// $request = "$requestMethod|$requestUri";

// $routes = require_once __DIR__ . "/../routes/books.php";

// foreach ($routes as $key => $route) {
    
// }
?>