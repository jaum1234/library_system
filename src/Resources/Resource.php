<?php

namespace Library\Resources;

abstract class Resource 
{
    public function format(array | object $resources)
    {
        if (!is_array($resources)) {
            return $this->formatResource($resources);
        }

        $formatedBooks = [];

        foreach ($resources as $resource) {
            array_push($formatedBooks, $this->formatResource($resource));
        }

        return $formatedBooks;
    }

    abstract protected function formatResource(object $resource): array;
}