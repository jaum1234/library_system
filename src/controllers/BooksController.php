<?php

namespace Library\controllers;

use Library\helper\EntityManagerCreator;
use Library\models\Book;


class BooksController
{
    public static function list()
    {
        $entityManager = EntityManagerCreator::create();

        $bookRepository = $entityManager->getRepository(Book::class);

        $books = $bookRepository->findAll();

        $formatedBooks = [];

        foreach ($books as $book) {
            array_push($formatedBooks, [
                "Id" => $book->id(),
                "Name" => $book->name(),
            ]);
        }

        return json_encode($formatedBooks);
    }
}