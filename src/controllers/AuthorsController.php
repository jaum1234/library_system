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

    public function list(Request $request, Response $response): array
    {
        return [];
    }

    public function show(Request $request, Response $response): array
    {
        return [];
    }

    public function update(Request $request, Response $response): void
    {

    }

    public function destroy(Request $request, Response $response): void
    {

    }
}