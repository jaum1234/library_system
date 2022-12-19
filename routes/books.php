<?php

use Library\Controllers\BooksController;

require_once __DIR__ . "/../vendor/autoload.php";

$uri = $_SERVER["REQUEST_URI"];

$id = explode("/", $uri)[2];

return [
    "GET|/books" => [BooksController::class, "list"],
    "POST|/books" => [BooksController::class, "store"],
    "GET|/books/$id" => [BooksController::class, "show"],
    "DELETE|/books/$id" => [BooksController::class, "destroy"]
];