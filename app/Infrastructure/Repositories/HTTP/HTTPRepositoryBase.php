<?php


namespace App\Infrastructure\Repositories\HTTP;

use App\Domain\ValueObjects\Enums\HTTPMethods;
use App\Domain\ValueObjects\HTTPClientResponse;
use Illuminate\Support\Facades\Http as HTTPClient;

class HTTPRepositoryBase
{

    private HTTPClient $client;

    public function request($method, $uri, $body, $query, $headers): HTTPClientResponse
    {
        $response = HTTPClient::$method($uri);
        return new HTTPClientResponse($response->status(), $response->json());
    }

    protected function get(string $uri, array $query = [], array $headers = []): HTTPClientResponse
    {
        return $this->request(HTTPMethods::GET, $uri, [], $query, $headers);
    }

    protected function post(string $uri, array $body = [], array $query = [], array $headers = []): HTTPClientResponse
    {
        return $this->request(HTTPMethods::POST, $uri, $body, $query, $headers);
    }

    protected function put(string $uri, array $body = [], array $query = [], array $headers = []): HTTPClientResponse
    {
        return $this->request(HTTPMethods::PUT, $uri, $body, $query, $headers);
    }

    protected function patch(string $uri, array $body = [], array $query = [], array $headers = []): HTTPClientResponse
    {
        return $this->request(HTTPMethods::PATCH, $uri, $body, $query, $headers);
    }

}
