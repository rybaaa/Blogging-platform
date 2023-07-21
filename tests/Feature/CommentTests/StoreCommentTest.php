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
        $author = User::factory()->createOne();
        $article = Article::factory()->createOne();
        $response = $this->postJson(route('comments.store'),
    [
        'author_id' => $author->id,
        'article_id' => $article->id,
        'content' => 'testing tests'
    ]);

        $response->assertStatus(201);
        $comments = Comment::all();
        $this->assertCount(1, $comments);
    }

    public function test_comment_store_throws_error_when_not_authenticated(): void
    {
        $article = Article::factory()->createOne();

        $response = $this->postJson(
            route('comments.store'),
            [
                'article_id' => $article->id,
                'content' => 'foobar',
            ]
        );

        $response->assertStatus(422);
        $comments = Comment::all();
        $this->assertEmpty($comments);
    }

    public function test_comment_store_with_debug_middleware(): void
    {
        $author = User::factory()->createOne();
        $article = Article::factory()->createOne();
        $response = $this->postJson(route('comments.store'),
    [
        'author_id' => $author->id,
        'article_id' => $article->id,
        'content' => 'laravel'
    ]);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>['content', 'author_id', 'article_id']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'laravel',
                'author_id' => $author->id,
                'article_id' => $article->id
            ],
        ]);
    }
}
