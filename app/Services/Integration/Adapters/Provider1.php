<?php

namespace App\Services\Integration\Adapters;

use App\Enums\TodoProviders;
use App\Services\Integration\DataTransferObjects\TodoItem;
use App\Services\Integration\DataTransferObjects\Todos;
use App\Services\Integration\IntegrationAdapter;
use App\Services\Integration\IntegrationAdapterInterface;

class Provider1 extends IntegrationAdapter implements IntegrationAdapterInterface
{
    protected string $endpoint = 'https://run.mocky.io/v3/27b47d79-f382-4dee-b4fe-a0976ceda9cd';
    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getTodos(): ?Todos
    {
        $todos = $this->getConnectTodos();
        $todoItems = Todos::builder();
        foreach ($todos as $todo) {
            $todoItems->setItems(
                TodoItem::builder()
                    ->setProvider(TodoProviders::PROVIDER1)
                    ->setName($todo['id'])
                    ->setPoints($todo['zorluk'] ?? '')
                    ->setEstimatedDuration($todo['sure'] ?? '')
            );
        }

        return $todoItems;
    }
}
