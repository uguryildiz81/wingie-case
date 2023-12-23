<?php

namespace App\Services\Integration;


use App\Services\Integration\DataTransferObjects\Todos;
use GuzzleHttp\Client;

abstract class IntegrationAdapter
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    protected function getConnectTodos(): array
    {
        $response = $this->client->request('GET', $this->getEndpoint());

        return json_decode($response->getBody()->getContents(), true);
    }

    abstract protected function getEndpoint(): string;

    abstract public function getTodos(): ?Todos;
}
