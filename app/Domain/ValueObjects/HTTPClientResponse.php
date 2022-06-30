<?php


namespace App\Domain\ValueObjects;


use JetBrains\PhpStorm\ArrayShape;

class HTTPClientResponse
{
    public int $statusCode;
    public mixed $body;
    public array $header;

    public function __construct(int $statusCode, $body = null, array $header = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->header = $header;
    }

    /**
     * @return array
     */
    #[ArrayShape(['http_status_code' => "int", 'body' => "mixed|null", 'header' => "array"])]
    public function toArray(): array
    {
        return [
            'http_status_code'=> $this->statusCode,
            'body'=> $this->body,
            'header'=> $this->header
        ];
    }
}
