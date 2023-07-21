<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCommentTest extends TestCase
{
    public function test_comment_show(): void
    {
        $comments = Comment::factory()->count(5)->create();
        $requiredComment = $comments[0];

        $response = $this->get(route('comments.show', [$requiredComment->id]));

        $response->assertStatus(200);
        $this->assertCount(5, $comments);
        $this->assertEquals( $requiredComment->id, $comments[0]->id);
    }

    public function test_comment_show_with_debug_middleware(): void
    {
        $comments = Comment::factory()->count(5)->create();
        $requiredComment = $comments[0];

        $response = $this->get(route('comments.show', [$requiredComment->id]));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>[]
            ],
        ]);
    }
}
