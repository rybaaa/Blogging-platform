<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutUserTest extends TestCase
{
    public function test_user_logout(): void
    {
        $user = User::factory()->createOne();

        $response = $this
            ->actingAs($user)
            ->getJson('api/logout');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'You are logged out'
        ]);
    }

    public function test_user_logout_throws_error_when_not_auth(): void
    {
        $response = $this
            ->getJson('api/logout');

        $response->assertStatus(401);
    }
}
