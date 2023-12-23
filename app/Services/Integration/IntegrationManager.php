<?php

namespace App\Services\Integration;

use App\Enums\TodoProviders;
use App\Services\Integration\Adapters\Provider1;
use App\Services\Integration\Adapters\Provider2;

class IntegrationManager implements IntegrationManagerInterface
{
    /**
     * @param string $todoProvider
     * @return IntegrationAdapterInterface
     */
    public static function getIntegrationAdapter(string $todoProvider): IntegrationAdapterInterface
    {
        $provider = TodoProviders::tryFrom($todoProvider);
        return self::loadIntegration($provider);
    }

    public static function loadIntegration(TodoProviders $todoProvider): IntegrationAdapterInterface
    {
        return resolve(
            match ($todoProvider) {
                TodoProviders::PROVIDER1 => Provider1::class,
                TodoProviders::PROVIDER2 => Provider2::class,
            }
        );
    }
}
