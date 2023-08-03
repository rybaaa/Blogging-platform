<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateUserTest extends TestCase
{
    public function test_user_update(): void
    {
        $user = User::factory()
            ->set('name', 'testname')
            ->createOne();

        $response = $this
            ->actingAs($user)
            ->patchJson(
                route('users.update', [$user->id]),
                [
                    'name' => 'update name',
                ]
            );
        $user->refresh();

        $response->assertStatus(200);
        $this->assertEquals('update name', $user->name);
    }

    public function test_user_update_with_avatar(): void
    {
        Storage::fake('public/avatars');
        $avatar = UploadedFile::fake()->image('avatar1.jpg');
        $user = User::factory()
            ->set('name', 'testname')
            ->createOne();

        $response = $this
            ->actingAs($user)
            ->patchJson(
                route('users.update', [$user->id]),
                [
                    'name' => 'update name',
                    'avatar' => $avatar
                ]
            );
        $user->refresh();

        $response->assertStatus(200);
        $this->assertEquals('update name', $user->name);
        $this->assertNotNull('avatar', $user->avatar);
    }

    public function test_user_update_with_avatar_throws_error_when_avatar_not_img(): void
    {
        Storage::fake('public/avatars');
        $avatar = UploadedFile::fake()->image('avatar1.pdf');
        $user = User::factory()
            ->set('name', 'testname')
            ->createOne();

        $response = $this
            ->actingAs($user)
            ->patchJson(
                route('users.update', [$user->id]),
                [
                    'name' => 'update name',
                    'avatar' => $avatar
                ]
            );
        $user->refresh();

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The avatar field must be an image.'
        ]);
    }

    public function test_user_update_throws_error_when_not_authenticated(): void
    {
        Storage::fake('public/avatars');
        $avatar = UploadedFile::fake()->image('avatar1.jpg');
        $user = User::factory()
            ->set('name', 'testname')
            ->createOne();

        $response = $this
            ->patchJson(
                route('users.update', [$user->id]),
                [
                    'name' => 'update name',
                    'avatar' => $avatar
                ]
            );

        $response->assertStatus(401);
    }

    public function test_user_update_throws_error_when_not_able_to_update_other_user(): void
    {
        Storage::fake('public/avatars');
        $avatar = UploadedFile::fake()->image('avatar1.jpg');
        $user1 = User::factory()
            ->set('id', 10)
            ->set('name', 'testname')
            ->createOne();
        $user2 = User::factory()
            ->set('id', 55)
            ->set('name', 'testname')
            ->createOne();

        $response = $this
            ->actingAs($user1)
            ->patchJson(
                route('users.update', $user2->id),
                [
                    'name' => 'update name',
                    'avatar' => $avatar
                ]
            );

        $response->assertStatus(403);
    }
}
