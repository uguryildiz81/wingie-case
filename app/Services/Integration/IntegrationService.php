<?php

namespace App\Services\Integration;

use App\Models\Developer;
use App\Models\Todo;
use App\Services\Integration\DataTransferObjects\TodoItem;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class IntegrationService
{
    /**
     * @param string $todoProvider
     * @return Collection
     * @throws Exception
     */
    public function insertProvider(string $todoProvider): Collection
    {
        $adapter = IntegrationManager::getIntegrationAdapter($todoProvider);
        $todos = $adapter->getTodos();
        return $todos->getItems()->map(function (TodoItem $todo) {
            return Todo::firstOrCreate(
                [
                    'provider' => $todo->getProvider(),
                    'name' => $todo->getName(),
                ],
                $todo->toModelArray()
            );
        });
    }

    /**
     * @param int $points
     * @return Developer|null
     */
    private function findDeveloper(int $points): Developer|null
    {
        return Developer::query()->select(DB::raw(sprintf('*,%s/level as new_points', $points)))->orderBy('total_assign_hour', 'asc')->orderBy('new_points', 'asc')->first();
    }

    public function updateTodoDevelopers(): Collection
    {
        return Todo::query()->whereNull('developer_id')->get()->map(function (Todo $todo) {
            $developer = $this->findDeveloper($todo->estimated_duration * $todo->points);
            if ($developer === null) {
                return $todo;
            }
            $todo->developer_id = $developer->id;
            $todo->save();
            $developer->total_assign_hour = $developer->total_assign_hour + (($todo->estimated_duration * $todo->points) / $developer->level);
            $developer->save();
            return $todo;
        });
    }

    /**
     * @return Collection|null
     */
    public function getPlans(): ?Collection
    {
        return Developer::query()->select(
            DB::raw(sprintf('*,total_assign_hour/%s as total_week', config('integration.weekHours')))
        )->get();
    }
}
