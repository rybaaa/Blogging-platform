<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyUserTest extends TestCase
{
    public function test_user_destroy(): void
    {
        $user1 = User::factory()
            ->set('id', 20)
            ->createOne();
        $user2 = User::factory()
            ->set('id', 11)
            ->createOne();

        $response = $this
            ->actingAs($user1)
            ->deleteJson(route('users.destroy', [$user1->id]));

        $response->assertStatus(200);
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseMissing('users', ['id' => $user1->id]);
    }

    public function test_user_destroy_throws_error_when_not_authenticated()
    {
        $user = User::factory()->createOne();

        $response = $this->deleteJson(
            route('users.destroy',  [$user->id])
        );

        $response->assertStatus(401);
    }

    public function test_user_destroy_not_able_to_delete_other_user()
    {
        $user1 = User::factory()
            ->set('id', 20)
            ->createOne();
        $user2 = User::factory()
            ->set('id', 10)
            ->createOne();

        $response = $this
            ->actingAs($user1)
            ->deleteJson(route('users.destroy', [$user2->id]));

        $response->assertStatus(403);
        $this->assertDatabaseCount('users', 2);
    }
}
