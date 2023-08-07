<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeUserTest extends TestCase
{
    public function test_user_me(): void
    {
        $user = User::factory()->createOne();

        $response = $this
            ->actingAs($user)
            ->getJson('api/me');

        $response->assertStatus(200);
    }

    public function test_user_me_throws_error_when_not_auth(): void
    {
        $response = $this
            ->getJson('api/me');

        $response->assertStatus(401);
    }
}
