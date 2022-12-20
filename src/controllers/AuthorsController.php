<?php

namespace Library\Controllers;

use Library\Interfaces\Crud;

use Library\Helpers\Request;
use Library\Helpers\Response;
use Library\Repositories\AuthorRepository;

class AuthorsController implements Crud
{
    private AuthorRepository $authorRepository;

    function __construct()
    {
        $this->authorRepository = new AuthorRepository();
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

        return $response->json($authors);
    }

    public function show(Request $request, Response $response)
    {
        $author = $this->authorRepository->fetch(["id" => $request->id()]);
        
        return $response->json($author);
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

}