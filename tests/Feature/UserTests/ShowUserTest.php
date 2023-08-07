<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowUserTest extends TestCase
{

    public function test_user_show(): void
    {
        $user = User::factory()->createOne();

        $response = $this->get(route('users.show', [$user->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'name',
            'email',
            'avatar'
        ]);
    }
}
