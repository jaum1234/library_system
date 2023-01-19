<?php 

namespace Library\Helpers;

class Request 
{
    private string $uri;
    private string $method;
    private array | null $body;
    private int $id;
    private string $resource;

    public function __construct()
    {
        $segregatedURI = $this->segregateURI();

        $this->uri = $_SERVER["REQUEST_URI"];
        $this->id = $segregatedURI["id"];
        $this->resource = $segregatedURI["resource"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->body = $this->extractBody();
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function body(): array | null
    {
        return $this->body;
    }

    public function resource(): string
    {
        return $this->resource;
    }

    private function extractBody(): array | null
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function id(): int
    {
        return $this->id;
    }

    private function segregateURI(): array
    {
        $URI = $_SERVER["REQUEST_URI"];

        $segregatedURI = explode("/", $URI);

        return [
            "resource" => $segregatedURI[1],
            "id" => intval($segregatedURI[2])
        ];
    }
}