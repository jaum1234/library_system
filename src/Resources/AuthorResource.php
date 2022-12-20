<?php

namespace Library\Resources;

use Library\Resources\Resource;

class AuthorResource extends Resource
{
    protected function formatResource(array | object $author): array
    {
        return [
            "id" => $author->id(),
            "name" => $author->name()
        ];
    }
}