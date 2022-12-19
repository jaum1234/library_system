<?php

namespace Library\Interfaces;

use Library\Helpers\Request;
use Library\Helpers\Response;

interface Crud
{
    public function list(Request $request, Response $response): array;
    public function show(Request $request, Response $response): array;
    public function create(Request $request, Response $response): void;
    public function update(Request $request, Response $response): void;
    public function destroy(Request $request, Response $response): void;
}