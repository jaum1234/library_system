<?php

use Library\Helpers\EntityManagerCreator;
use Library\models\Book;

require_once __DIR__ . "/../vendor/autoload.php";

$entityManager = EntityManagerCreator::create();

$book = new Book($argv[1]);

$entityManager->persist($book);
$entityManager->flush();