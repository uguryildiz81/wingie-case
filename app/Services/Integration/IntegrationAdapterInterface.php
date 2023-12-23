<?php

namespace App\Services\Integration;

use App\Services\Integration\DataTransferObjects\Todos;

interface IntegrationAdapterInterface
{
    public function getTodos(): ?Todos;
}
