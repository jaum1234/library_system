<?php

namespace Library\Helpers;

class Response
{
    public function json($data)
    {
        return json_encode($data);
    }

    public function status(int $status = 0): int | Response
    {
        if ($status === 0) {
            return http_response_code();
        }
        
        http_response_code($status);

        return $this;
    }
}