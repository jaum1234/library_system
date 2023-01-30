<?php

namespace Library\Resources;

use Library\Resources\Resource;

class CustomerResource extends Resource
{
    protected function formatResource(array | object $customer): array
    {
        return [
            "id" => $customer->id(),
            "name" => $customer->name(),
        ];
    }

  
}