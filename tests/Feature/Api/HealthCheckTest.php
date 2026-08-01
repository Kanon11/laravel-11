<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_health_endpoint_returns_ok(): void
    {
        $response = $this->getJson('/api/health');

        $response->assertOk()
            ->assertJson(['status' => 'ok'])
            ->assertJsonStructure(['status', 'timestamp']);
    }

    public function test_route_check_middleware_logs_without_corrupting_the_response(): void
    {
        Log::shouldReceive('info')
            ->once()
            ->with('1', ['route' => 'api.health', 'path' => 'api/health']);

        $this->getJson('/api/health')
            ->assertOk()
            ->assertJson(['status' => 'ok'])
            ->assertHeader('content-type', 'application/json');
    }
}
