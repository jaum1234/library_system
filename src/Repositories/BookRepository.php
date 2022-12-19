<?php

namespace Library\repositories;

use Library\Helpers\EntityManagerCreator;
use Library\Models\Book;

class BookRepository
{
    private $repository;
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::create();
        $this->repository = $this->entityManager->getRepository(Book::class);
    }

    public function create(string $name): void
    {
        $book = new Book($name);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function fetchAll(): array
    {
        $books = $this->repository->findAll();

        $formatedBooks = [];

        foreach ($books as $book) {
            array_push($formatedBooks, [
                "id" => $book->id(),
                "name" => $book->name(),
            ]);
        }

        return $formatedBooks;
    }

    public function fetch(array $criteria): array
    {
        $book = $this->repository->findOneBy($criteria);

        if ($book === null) {
            return [];
        }

        return [
            "id" => $book->id(),
            "name" => $book->name()
        ];
    }

    public function remove(array $criteria): void
    {
        $book = $this->repository->findOneBy($criteria);

        if ($book === null) {
            return;
        }

        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }
}