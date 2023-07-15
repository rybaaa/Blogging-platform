<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexCommentTest extends TestCase
{
    public function test_comment_index(): void
    {
        $comments = Comment::factory()->count(5)->create();

        $response = $this->get(route('comments.index'));

        $response->assertStatus(200);
        $this->assertCount(5, $comments);
    }
}
