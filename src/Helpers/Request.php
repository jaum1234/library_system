<?php 

namespace Library\Helpers;

class Request 
{
    private string $uri;
    private string $method;
    private array | null $body;
    private array $ids;
    private array $resources;

    public function __construct()
    {
        $segregatedURI = $this->segregateURI();

        $this->uri = $_SERVER["REQUEST_URI"];
        $this->ids = $segregatedURI["ids"];
        $this->resources = $segregatedURI["resources"];
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

    public function resources(): array
    {
        return $this->resources;
    }

    private function extractBody(): array | null
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function ids(): array
    {
        return $this->ids;
    }

    private function segregateURI(): array
    {
        $URI = $_SERVER["REQUEST_URI"];


        $segregatedURI = explode("/", $URI);

        $primaryResource = $segregatedURI[1];
        $secondaryResource = $segregatedURI[3];


        $primaryId = intval($segregatedURI[2]);
        $secondaryId = intval($segregatedURI[4]);


        return [
            "resources" => [$primaryResource, $secondaryResource],
            "ids" => [$primaryId, $secondaryId]
        ];
    }
}