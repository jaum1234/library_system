<?php

namespace Library\Controllers;

use Library\Helpers\EntityManagerCreator;
use Library\Models\Book;
use Library\Repositories\BookRepository;
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

        $this->bookRepository->store($data["name"]);

        $response->status(201);
    }

    public function show(Request $request, Response $response)
    {
        $book = $this->bookRepository->fetch(["id" => $request->id()]);
        
        return $response->json($book);
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
    }

}