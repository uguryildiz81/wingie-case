<?php

namespace App\Services\Integration\DataTransferObjects;

use App\Models\Todo;
use Illuminate\Support\Collection;

class Todos
{
    private ?array $items;

    public static function builder(): static
    {
        return new static();
    }

    public function getItems(): Collection
    {
        return collect($this->items);
    }

    public function setItems(TodoItem|Todo|null $item): Todos
    {
        $this->items[] = $item;
        return $this;
    }
}
