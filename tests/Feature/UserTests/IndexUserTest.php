<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_index(): void
    {
        User::factory()->count(20)->create();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('users', 20);
    }

    public function test_user_index_with_pagination(): void
    {
        User::factory()->count(20)->create();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');

        $responseData = $response->json();
        $nextPage = $responseData['next_page_url'];

        $nextResponse = $this->get($nextPage);

        $nextResponse->assertJsonCount(5, 'data');
    }
}
