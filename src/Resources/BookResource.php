<?php

namespace Library\Resources;

use Library\Resources\Resource;

class BookResource extends Resource
{
    protected function formatResource(array | object $book): array
    {
        return [
            "id" => $book->id(),
            "name" => $book->name(),
        ];
    }

  
}