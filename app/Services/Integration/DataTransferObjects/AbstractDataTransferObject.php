<?php

namespace App\Services\Integration\DataTransferObjects;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractDataTransferObject
{
    /**
     * Transforms data transfer object to array.
     *
     * @param array<int, string> $only
     * @param array<int, string> $except
     * @return array<string, mixed>
     */
    public function toArray(array $only = [], array $except = []): array
    {
        $properties = (new ReflectionClass($this))->getProperties();
        $array = [];

        foreach ($properties as $property) {
            if (!empty($only) && !in_array($property->getName(), $only)) {
                continue;
            }

            if (!empty($except) && in_array($property->getName(), $except)) {
                continue;
            }

            $value = $property->getValue($this);

            if ($value instanceof AbstractDataTransferObject || $value instanceof Collection) {
                $value = $value->toArray();
            }

            $array[$property->getName()] = $value;
        }

        return $array;
    }

    /**
     * Transforms data transfer object to model array.
     *
     * @param array<int, string> $only
     * @param array<int, string> $except
     * @return array<string, mixed>
     */
    public function toModelArray(array $only = [], array $except = []): array
    {
        $array = $this->toArray($only, $except);
        $modelArray = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = new Collection($value);
            }

            $modelArray[Str::snake($key)] = $value;
        }

        return $modelArray;
    }
}
