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
    use DatabaseTransactions;
    /**
     * Test login
     * 
     * @test
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
}
