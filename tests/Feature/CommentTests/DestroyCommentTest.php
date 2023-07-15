<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyCommentTest extends TestCase
{
    public function test_comment_destroy(): void
    {
        $comments = Comment::factory()->count(5)->create();
        $requiredComment = $comments[0];

        $response = $this->delete(route('comments.destroy', [$requiredComment->id]));

        $response->assertStatus(204);
        $updatedComments = Comment::all();
        $this->assertCount(4, $updatedComments);
        $this->assertDatabaseMissing('comments', ['id' => $requiredComment->id]);
    }
}
