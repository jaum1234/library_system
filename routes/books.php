<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Library\controllers\BooksController;

return [
    "GET|/books" => BooksController::list()
];