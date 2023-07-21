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
        $response->assertJsonCount(5, 'data');
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
}
