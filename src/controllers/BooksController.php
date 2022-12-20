<?php

namespace Library\Controllers;

use Library\Helpers\EntityManagerCreator;
use Library\Models\Book;
use Library\Repositories\BookRepository;
use Library\Helpers\Response;
use Library\Helpers\Request;
use Library\Interfaces\Crud;
use Library\Resources\AuthorResource;
use Library\Resources\BookResource;

class BooksController implements Crud
{
    private $bookRepository;
    private BookResource $bookResource;
    private AuthorResource $authorResource;

    function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->bookResource = new BookResource();
        $this->authorResource = new AuthorResource();
    }

    public function list(Request $request, Response $response)
    {
        $books = $this->bookRepository->fetchAll();

        $formatedBooks = $this->bookResource->format($books);

        return $response->json($formatedBooks);
    }

    public function create(Request $request, Response $response)
    {
        $data = $request->body();

        $this->bookRepository->store($data);

        $response->status(201);
    }

    public function show(Request $request, Response $response)
    {
        $book = $this->bookRepository->fetch(["id" => $request->id()]);

        if ($book === null) return $response->status(404);

        $formatedBook = $this->bookResource->format($book);
        
        return $response->json($formatedBook);
    }

    public function destroy(Request $request, Response $response)
    {
        $id = $request->id();

        $this->bookRepository->remove([
            "id" => $id
        ]);

        $response->status(204);
    }

    public function update(Request $request, Response $response)
    {
        $data = $request->body();
        $id = $request->id();

        $this->bookRepository->update(
            ["id" => $id],
            $data
        );

        $response->status(200);
    }

    public function listBookAuthors(Request $request, Response $response)
    {
        $id = $request->id();

        $book = $this->bookRepository->fetch(["id" => $id]);

        $bookAuthors = $book->authors();


        $formatedAuthors = $this->authorResource->format($bookAuthors);

        return $response->status(200)->json($formatedAuthors);
    }

}