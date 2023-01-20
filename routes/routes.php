<?php

use Library\Controllers\AuthorsController;
use Library\Controllers\BooksController;
use Library\Helpers\Request;

require_once __DIR__ . "/../vendor/autoload.php";

$request = new Request();

$id = $request->ids()[0];

$booksRoutes = [
    "GET|/books" => [BooksController::class, "list"],
    "POST|/books" => [BooksController::class, "create"],
    "GET|/books/$id" => [BooksController::class, "show"],
    "DELETE|/books/$id" => [BooksController::class, "destroy"],
    "PUT|/books/$id" => [BooksController::class, "update"],
    "GET|/books/$id/authors" => [BooksController::class, "listBookAuthors"]
];

$authorsRoutes = [
    "POST|/authors" => [AuthorsController::class, "create"],
    "GET|/authors" => [AuthorsController::class, "list"],
    "GET|/authors/$id" => [AuthorsController::class, "show"],
    "PUT|/authors/$id" => [AuthorsController::class, "update"],
    "DELETE|/authors/$id" => [AuthorsController::class, "destroy"],
    "GET|/authors/$id/books" => [AuthorsController::class, "listAuthorBooks"]
];

$customersRoutes = [
    "GET|/customers" => []
];

return array_merge($booksRoutes, $authorsRoutes, $customersRoutes);
    
?>

