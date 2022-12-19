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
        $authors = $this->repository->findAll();

        $formatedAuthors = [];

        foreach ($authors as $author) {
            array_push($formatedAuthors, [
                "id" => $author->id(),
                "name" => $author->name(),
            ]);
        }

        return $formatedAuthors;
    }

    public function fetch(array $criteria): array
    {
        $author = $this->repository->findOneBy($criteria);

        if ($author === null) {
            return [];
        }

        return [
            "id" => $author->id(),
            "name" => $author->name()
        ];
    }

    public function update(array $criteria, array $data): void
    {

    }

    public function remove(array $criteria): void
    {

    }

    
}