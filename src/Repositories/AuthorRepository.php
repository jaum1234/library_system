<?php

namespace Library\Repositories;

use Library\Helpers\EntityManagerCreator;
use Library\Interfaces\Repository;
use Library\Models\Author;

class AuthorRepository implements Repository
{
    private $authorRepository;
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::create();
        $this->authorRepository = $this->entityManager->getRepository(Author::class);
    }

    public function store(array $data): void
    {
        $author = new Author($data["name"]);

        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }

    public function fetchAll(): array
    {
        return [];
    }

    public function fetch(array $criteria): array
    {
        return [];
    }

    public function update(array $criteria, array $data): void
    {

    }

    public function remove(array $criteria): void
    {

    }

    
}