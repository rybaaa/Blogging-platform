<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Comment;
use Tests\TestCase;

class UpdateCommentTest extends TestCase
{
    public function test_comment_update(): void
    {
        $comment = Comment::factory()->createOne();

        $response = $this->patch(route('comments.update', [$comment->id]),
    [
        'content' => 'update comment'
    ]);

        $response->assertStatus(200);
        $comment->refresh();
        $comments = Comment::all();
        $this->assertCount(1, $comments);
        $this->assertEquals('update comment', $comment->content);
    }

    public function test_comment_update_with_debug_middleware(): void
    {
        $comment = Comment::factory()->createOne();

        $response = $this->patch(route('comments.update', [$comment->id]),
    [
        'content' => 'update comment'
    ]);

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>['content']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'update comment',
            ],
        ]);
    }
}
