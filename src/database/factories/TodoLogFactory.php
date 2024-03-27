<?php

namespace Database\Factories;

use App\Enums\TodoLogCategoryEnum;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoLog>
 */
class TodoLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resource = Todo::factory()->create();
        return [
            'todo_id' => $resource->id,
            'content' => fake()->text(),
            'scheduled_at' => now(),
            'expired_at' => now(),
            'data' => $resource->getOriginal(),
            'category' => TodoLogCategoryEnum::CREATE->value
        ];
    }
}
