<?php

namespace Library\Helpers;

class Response
{
    public function json($data)
    {
        return json_encode($data);
    }

    public function status(int $status = 0): int
    {
        if ($status === 0) {
            return http_response_code();
        }
        
        http_response_code($status);
    }
}