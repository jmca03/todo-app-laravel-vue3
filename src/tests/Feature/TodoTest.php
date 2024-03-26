<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Test index
     * 
     * @return void
     */
    public function test_index(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user, 'api')->getJson('/api/todo');

        // Assert
        $response->assertOk();
    }

    /**
     * Test show
     * 
     * @return void
     */
    public function test_show(): void
    {
        // Arrange
        $user = User::factory()->create();
        $todo = Todo::factory()->create();

        // Act
        $response = $this->actingAs($user, 'api')->getJson('/api/todo/' . $todo->id);

        // Assert
        $response->assertOk();
    }

    /**
     * Test create
     * 
     * @return void
     */
    public function test_create(): void
    {
        // Arrange
        $user = User::factory()->create();

        /**
         * @var array<object>
         */
        $payload = [
            'user_id' => $user->id,
            'content' => $this->faker->text(),
            'scheduled_at' => now(),
            'expired_at' => now()
        ];

        // Act
        $response = $this->actingAs($user, 'api')->postJson('/api/todo/', $payload);

        // Assert
        $response->assertOk();
    }

    /**
     * Test update
     * 
     * @return void
     */
    public function test_update(): void
    {
        // Arrange
        $user = User::factory()->create();
        $todo = Todo::factory()->create();

        /**
         * @var array<object>
         */
        $payload = [
            'user_id' => $user->id,
            'content' => $this->faker->text(),
            'scheduled_at' => now(),
            'expired_at' => now()
        ];

        // Act
        $response = $this->actingAs($user, 'api')->patchJson('/api/todo/' . $todo->id, $payload);

        // Assert
        $response->assertOk();
    }

    /**
     * Test delete
     * 
     * @return void
     */
    public function test_delete(): void
    {
        // Arrange
        $user = User::factory()->create();
        $todo = Todo::factory()->create();

        // Act
        $response = $this->actingAs($user, 'api')->deleteJson('/api/todo/' . $todo->id);

        // Assert
        $response->assertOk();
    }
}
