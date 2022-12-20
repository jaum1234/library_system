<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "authors")]
class Author
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue()]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: "authors")]
    private Collection $books;

    function __construct(string $name)
    {
        $this->name = $name;
        $this->books = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function books(): Collection
    {
        return $this->books;
    }

    public function setName(string $newName): void
    {
        $this->name = $newName;
    }

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }
}