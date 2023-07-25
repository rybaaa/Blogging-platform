<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Comment;
use Tests\TestCase;

class UpdateCommentTest extends TestCase
{
    public function test_comment_update(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $comment = Comment::factory()
            ->set('author_id', $author->id)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('comments.update', [$comment->id]),
                [
                    'content' => 'update comment'
                ]
            );

        $response->assertStatus(200);
        $comment->refresh();
        $comments = Comment::all();
        $this->assertCount(1, $comments);
        $this->assertEquals('update comment', $comment->content);
    }

    public function test_comment_update_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $comment = Comment::factory()
            ->set('author_id', $author->id)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('comments.update', [$comment->id]),
                [
                    'content' => 'update comment'
                ]
            );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['content']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'update comment',
            ],
        ]);
    }

    public function test_comment_update_throws_error_when_not_authenticated(): void
    {
        $comment = Comment::factory()->createOne();

        $response = $this->patchJson(
            route('comments.update',  [$comment->id]),
            [
                'content' => 'update comment'
            ]
        );

        $response->assertStatus(401);
    }

    public function test_comment_update_throws_error_when_not_able_to_update_other_person_comment(): void
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
            ->patchJson(
                route('comments.update', [$comment->id]),
                [
                    'content' => 'update comment'
                ]
            );

        $response->assertStatus(403);
    }
}
