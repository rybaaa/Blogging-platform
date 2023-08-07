<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    public function test_user_auth(): void
    {
        User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '123456789')
            ->createOne();

        $response = $this
            ->postJson(
                '/api/auth',
                [
                    'email' => 'test@test.com',
                    'password' => '123456789'
                ]
            );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token'
        ]);
    }

    public function test_user_auth_with_wrong_credentials(): void
    {
        User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '123456789')
            ->createOne();

        $response = $this
            ->postJson(
                '/api/auth',
                [
                    'email' => 'user@test.com',
                    'password' => '11'
                ]
            );

        $response->assertStatus(422);
    }
}
