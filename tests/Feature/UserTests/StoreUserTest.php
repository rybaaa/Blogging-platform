<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;


class StoreUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_store(): void
    {
        $response = $this
            ->postJson(
                route('users.store'),
                [
                    'name' => 'test name',
                    'email' => 'test@test.com',
                    'password' => '123456789'
                ]
            );

        $users = User::all();
        $user = User::query()->where('email', 'test@test.com')->first();


        $response->assertStatus(200);
        $this->assertCount(1, $users);
        $this->assertNull($user->avatar);
    }

    public function test_user_store_with_avatar(): void
    {
        Storage::fake('public/avatars');
        $avatar = UploadedFile::fake()->image('avatar1.jpg');

        $response = $this
            ->postJson(
                route('users.store'),
                [
                    'name' => 'test name',
                    'email' => 'test@test.com',
                    'password' => '123456789',
                    'avatar' => $avatar
                ]
            );

        $users = User::all();
        $user = User::query()->where('email', 'test@test.com')->first();

        $response->assertStatus(200);
        $this->assertCount(1, $users);
        $this->assertNotNull($user->avatar);
    }
}
