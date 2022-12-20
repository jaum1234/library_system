<?php

namespace Library\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "books")]
class Book 
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: "string", nullable: false)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: "books")]
    #[ORM\JoinTable(name: "authors_books")]
    private Collection $authors;

    function __construct(string $name)
    {
        $this->name = $name;
        $this->authors = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function authors(): Collection
    {
        return $this->authors;
    }

    public function setName(string $newName): void
    {
        $this->name = $newName;
    }

    public function addAuthor(Author $author): void
    {
        $author->addBook($this);
        $this->authors[] = $author;
    } 
}

?>