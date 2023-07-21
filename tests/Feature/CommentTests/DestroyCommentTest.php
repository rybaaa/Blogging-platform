<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyCommentTest extends TestCase
{
    public function test_comment_destroy(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $comment = Comment::factory()
            ->set('author_id', $author->id)
            ->set('id', 10)
            ->createOne();
        Comment::factory()->count(5)->create();       

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('comments.destroy', [$comment->id]));

        $response->assertStatus(200);
        $updatedComments = Comment::all();
        $this->assertCount(5, $updatedComments);
        $this->assertDatabaseMissing('comments', ['id' => 10]);
    }

    public function test_comment_destroy_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $comment = Comment::factory()
            ->set('author_id', $author->id)
            ->set('id', 100)
            ->createOne();
        
        Comment::factory()->count(5)->create();   

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('comments.destroy', [$comment->id]));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>[]
            ],
        ]);
    }

    public function test_comment_destroy_throws_error_when_not_authenticated(): void
    {
        $comment = Comment::factory()->createOne();

        $response = $this->deleteJson(
            route('comments.destroy',  [$comment->id]));

        $response->assertStatus(401);
    }

    public function test_comment_destroy_throws_error_when_not_able_to_delete_other_person_comment(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->set('id', 10)
            ->createOne();
        $comment = Comment::factory()
            ->set('author_id', 2)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(route('comments.destroy', [$comment->id]));

        $response->assertStatus(403);
    }
}
