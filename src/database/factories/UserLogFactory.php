<?php

namespace Database\Factories;

use App\Enums\UserLogCategoryEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLog>
 */
class UserLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resource = User::factory()->create();
        return [
            'user_id' => $resource->id,
            'user_agent' => $this->faker->userAgent(),
            'ip_address' => $this->faker->ipv4(),
            'data' => $resource->getOriginal(),
            'category' => UserLogCategoryEnum::LOGIN->value
        ];
    }
}
