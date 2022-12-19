<?php

namespace Library\Interfaces;

use Library\Helpers\Request;
use Library\Helpers\Response;

interface Crud
{
    public function list(Request $request, Response $response);
    public function show(Request $request, Response $response);
    public function create(Request $request, Response $response);
    public function update(Request $request, Response $response);
    public function destroy(Request $request, Response $response);
}