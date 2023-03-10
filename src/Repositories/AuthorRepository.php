<?php

namespace Library\Repositories;

use Library\Helpers\EntityManagerCreator;
use Library\Interfaces\Repository;
use Library\Models\Author;

class AuthorRepository implements Repository
{
    private $repository;
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::create();
        $this->repository = $this->entityManager->getRepository(Author::class);
    }

    public function store(array $data): void
    {
        $author = new Author($data["name"]);

        $this->entityManager->persist($author);
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

    public function update(array $criteria, array $data): void
    {
        $author = $this->repository->findOneBy($criteria);

        if ($author === null) return;

        $author->setName($data["name"]);

        $this->entityManager->flush();
    }

    public function remove(array $criteria): void
    {
        $author = $this->repository->findOneBy($criteria);

        if ($author === null) return;

        $this->entityManager->remove($author);
        $this->entityManager->flush();
    }
}