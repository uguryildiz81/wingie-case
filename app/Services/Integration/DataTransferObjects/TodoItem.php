<?php

namespace App\Services\Integration\DataTransferObjects;

use App\Enums\TodoProviders;

class TodoItem extends AbstractDataTransferObject
{
    private TodoProviders $provider;
    private int $points;
    private int $estimatedDuration;
    private string $name;

    public static function builder(): static
    {
        return new static();
    }

    public function getProvider(): TodoProviders
    {
        return $this->provider;
    }

    public function setProvider(TodoProviders $provider): TodoItem
    {
        $this->provider = $provider;
        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): TodoItem
    {
        $this->points = $points;
        return $this;
    }

    public function getEstimatedDuration(): int
    {
        return $this->estimatedDuration;
    }

    public function setEstimatedDuration(int $estimatedDuration): TodoItem
    {
        $this->estimatedDuration = $estimatedDuration;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TodoItem
    {
        $this->name = $name;
        return $this;
    }
}
