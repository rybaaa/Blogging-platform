<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCommentTest extends TestCase
{
    public function test_comment_store(): void
    {
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        $article = Article::factory()
            ->set('author_id', $author->id)
            ->createOne();
        $response = $this
            ->actingAs($author, 'api')
            ->postJson(route('comments.store'),
                [
                    'article_id' => $article->id,
                    'content' => 'testing tests'
                ]);

        $response->assertStatus(201);
        $comments = Comment::all();
        $this->assertCount(1, $comments);
    }

    public function test_comment_store_throws_error_when_not_authenticated(): void
    {
        $article = Article::factory()
            ->createOne();

        $response = $this->postJson(
            route('comments.store'),
            [
                'article_id' => $article->id,
                'content' => 'foobar',
            ]
        );

        $response->assertStatus(401);
        $comments = Comment::all();
        $this->assertEmpty($comments);
    }

    public function test_comment_store_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        $article = Article::factory()->createOne();
        
        $response = $this
            ->actingAs($author, 'api')
            ->postJson(route('comments.store'),
                [
                    'article_id' => $article->id,
                    'content' => 'testing tests'
                ]);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>['content', 'article_id']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'testing tests',
                'article_id' => $article->id
            ],
        ]);
    }
}
