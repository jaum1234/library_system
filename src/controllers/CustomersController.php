<?php

namespace Library\Controllers;

use CustomerRepository;
use Library\Interfaces\Crud;
use Library\Helpers\Request;
use Library\Helpers\Response;

class CustomersController implements Crud
{
    private CustomerRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository();
    }

    public function list(Request $request, Response $response)
    {

    }

    public function show(Request $request, Response $response)
    {
        
    }

    public function create(Request $request, Response $response)
    {
        $data = $request->body();

        $this->repository->store($data);

        $response->status(201);
    }

    public function update(Request $request, Response $response)
    {
        
    }

    public function destroy(Request $request, Response $response)
    {
        
    }
}

?>