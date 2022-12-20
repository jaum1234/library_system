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
        return $this->repository->findAll(); 
    }

    public function fetch(array $criteria): object | null
    {
        return $this->repository->findOneBy($criteria);
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