<?php

namespace Library\Repositories;

use Library\Helpers\EntityManagerCreator;
use Library\Interfaces\Repository;
use Library\Models\Author;
use Library\Models\Book;

class BookRepository implements Repository
{
    private $repository;
    private $entityManager;
    private $authorRepository;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::create();
        $this->repository = $this->entityManager->getRepository(Book::class);
        $this->authorRepository = $this->entityManager->getRepository(Author::class);
    }

    public function store(array $data): void
    {
        $book = new Book($data["name"]);

        if ($data["author_id"]) {
            $author = $this->authorRepository->findOneBy(["id" => $data["author_id"]]);
            $book->addAuthor($author);
        }
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function fetchAll(): array
    {
        $books = $this->repository->findAll();

        $formatedBooks = [];

        foreach ($books as $book) {
            $formatedAuthors = [];

            foreach($book->authors() as $author) {
                array_push($formatedAuthors, [
                    "id" => $author->id(),
                    "name" => $author->name()
                ]);
            }

            array_push($formatedBooks, [
                "id" => $book->id(),
                "name" => $book->name(),
                "authors" => $formatedAuthors
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

    public function update($criteria, $data): void
    {
        $book = $this->repository->findOneBy($criteria);

        $book->setName($data["name"]);

        $this->entityManager->flush();
    }
}