<?php

namespace App\Services\Integration;

interface IntegrationManagerInterface
{
    public static function getIntegrationAdapter(string $todoProvider): IntegrationAdapterInterface;
}
