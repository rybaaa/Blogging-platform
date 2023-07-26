<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexCommentTest extends TestCase
{
    public function test_comment_index(): void
    {
        Comment::factory()->count(5)->create();

        $response = $this->get(route('comments.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.data');
    }

    public function test_comment_index_with_debug_middleware(): void
    {
        $response = $this->get(route('comments.index'));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_comment_index_with_pagination(): void
    {
        Comment::factory()->count(100)->create();

        $response = $this->get(route('comments.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data.data');
        $response->assertJsonStructure([
            'data' => [
                'current_page',
                'data',
                'from',
                'last_page',
                'next_page_url',
                'per_page',
                'total'
            ]
        ]);
    }
}
