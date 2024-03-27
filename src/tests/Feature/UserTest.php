<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @var string */
    protected string $route = '/api/user';

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
        $response = $this->actingAs($user, 'api')->getJson($this->route);

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
        /** @var string|int */
        $id = $user->id;

        // Act
        $response = $this->actingAs($user, 'api')->getJson($this->route . '/' . $id);

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
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'Password@123',
        ];

        // Act
        $response = $this->actingAs($user, 'api')->postJson($this->route . '/', $payload);

        // Assert
        $response->assertCreated();
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
        /** @var string|int */
        $id = $user->id;

        /**
         * @var array<object>
         */
        $payload = [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'Password@123',
        ];

        // Act
        $response = $this->actingAs($user, 'api')->patchJson($this->route . '/' . $id, $payload);

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
        /** @var string|int */
        $id = $user->id;

        // Act
        $response = $this->actingAs($user, 'api')->deleteJson($this->route . '/' . $id);

        // Assert
        $response->assertOk();
    }
}
