<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'total_assign_hour' => $this->total_assign_hour,
            'total_week' => number_format($this->total_week, 2),
            'todos' => TodoResource::collection($this->todos)
        ];
    }
}
