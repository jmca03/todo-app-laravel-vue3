<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test if server is reachable.
     */
    public function test_health_check(): void
    {
        // Arrange
        // No pre-defined data needed.

        // Act
        $response = $this->getJson('/api/health-check');

        // Assert
        $response->assertOk();
    }
}
