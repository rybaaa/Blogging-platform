<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCommentTest extends TestCase
{
    public function test_comment_show(): void
    {
        $comment = Comment::factory()
            ->set('id', 10)
            ->set('content', 'comment')
            ->createOne();
        Comment::factory()->count(5)->create();

        $response = $this->get(route('comments.show', [$comment->id]));

        $response->assertStatus(200);
        $this->assertEquals('comment', $comment->content);
    }

    public function test_comment_show_with_debug_middleware(): void
    {
        $comment = Comment::factory()
            ->set('id', 10)
            ->set('content', 'comment')
            ->createOne();
        Comment::factory()->count(5)->create();

        $response = $this->get(route('comments.show', [$comment->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }
}
