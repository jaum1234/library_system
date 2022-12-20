<?php

namespace Library\Controllers;

use Library\Interfaces\Crud;

use Library\Helpers\Request;
use Library\Helpers\Response;
use Library\Repositories\AuthorRepository;
use Library\Resources\AuthorResource;
use Library\Resources\BookResource;

class AuthorsController implements Crud
{
    private AuthorRepository $authorRepository;
    private AuthorResource $authorResource;
    private BookResource $bookResource;

    function __construct()
    {
        $this->authorRepository = new AuthorRepository();
        $this->authorResource = new AuthorResource();
        $this->bookResource = new BookResource();
    }

    public function create(Request $request, Response $response): void
    {
        $data = $request->body();

        $this->authorRepository->store($data);

        $response->status(201);
    }

    public function list(Request $request, Response $response)
    {
        $authors = $this->authorRepository->fetchAll();

        $formatedAuthors = $this->authorResource->format($authors);

        return $response->json($formatedAuthors);
    }

    public function show(Request $request, Response $response)
    {
        $author = $this->authorRepository->fetch(["id" => $request->id()]);

        if ($author === null) {
            return $response->status(404);
        }

        $formatedAuthor = $this->authorResource->format($author);
        
        return $response->json($formatedAuthor);
    }

    public function update(Request $request, Response $response): void
    {
        $id = $request->id();
        $data = $request->body();

        $this->authorRepository->update(
            ["id" => $id],
            $data
        );
    }

    public function destroy(Request $request, Response $response): void
    {
        $id = $request->id();

        $this->authorRepository->remove(["id" => $id]);

        $response->status(204);
    }

    public function listAuthorBooks(Request $request, Response $response)
    {
        $id = $request->id();

        $author = $this->authorRepository->fetch(["id" => $id]);

        $authorBooks = $author->books();

        $formatedBooks = $this->bookResource->format($authorBooks);

        $response->status(200)->json($formatedBooks);
    }

}