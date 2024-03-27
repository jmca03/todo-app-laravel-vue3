<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Test if user can login to the app
     * 
     * return void
     */
    public function test_login(): void
    {
        // Arrange
        $user = User::factory()->create()->toArray();
        /** @var array */
        $payload = [
            'username' => Arr::get($user, 'username'),
            'password' => 'password'
        ];

        // Act
        $response = $this->postJson('/api/auth/login', $payload);

        // Assert
        $response->assertOk();
    }

    /**
     * Test if user can logout
     * 
     * @return void
     */
    public function test_logout(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs(user: $user, guard: 'api')->postJson('/api/auth/logout');

        // Assert
        $response->assertOk();
    }

    /**
     * Test regoster
     * 
     * @return void
     */
    public function test_register(): void
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
        $response = $this->actingAs(user: $user, guard: 'api')->postJson('/api/auth/register', $payload);

        // Assert
        $response->assertCreated();
    }
}
