<?php

namespace Library\Resources;

use Doctrine\Common\Collections\Collection;

abstract class Resource 
{
    public function format(array | object $resources)
    {
        if (!is_array($resources) && !($resources instanceof Collection) ) {
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