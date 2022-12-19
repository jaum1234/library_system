<?php

namespace Library\Controllers;

use Library\Helpers\EntityManagerCreator;
use Library\Models\Book;
use Library\repositories\BookRepository;
use Library\Helpers\Response;
use Library\Helpers\Request;

class BooksController
{
    private $bookRepository;

    function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function list(Request $request, Response $response)
    {
        
        $books = $this->bookRepository->fetchAll();

        return $response->json($books);
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->body();

        $this->bookRepository->create($data["name"]);

        $response->status(201);
    }

    public function show(Request $request, Response $response)
    {
        $book = $this->bookRepository->fetch(["id" => $request->id()]);
        
        return $response->json($book);
    }

    public function destroy(Request $request, Response $response)
    {
        $this->bookRepository->remove([
            "id" => $request->id()
        ]);

        $response->status(204);
    }

}