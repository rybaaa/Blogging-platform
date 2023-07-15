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

        $response->assertStatus(204);
        $comment->refresh();
        $comments = Comment::all();
        $this->assertCount(1, $comments);
        $this->assertEquals('update comment', $comment->content);
    }
}
