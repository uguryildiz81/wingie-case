<?php

namespace App\Services\Integration\Adapters;

use App\Enums\TodoProviders;
use App\Services\Integration\DataTransferObjects\TodoItem;
use App\Services\Integration\DataTransferObjects\Todos;
use App\Services\Integration\IntegrationAdapter;
use App\Services\Integration\IntegrationAdapterInterface;

class Provider2 extends IntegrationAdapter implements IntegrationAdapterInterface
{
    protected string $endpoint = 'https://run.mocky.io/v3/7b0ff222-7a9c-4c54-9396-0df58e289143';

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
                    ->setProvider(TodoProviders::PROVIDER2)
                    ->setName($todo['id'])
                    ->setPoints($todo['value'] ?? '')
                    ->setEstimatedDuration($todo['estimated_duration'] ?? '')
            );
        }

        return $todoItems;
    }
}
