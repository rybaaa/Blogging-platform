<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreArticleTest extends TestCase
{
    public function test_article_store(): void
    {
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        $response = $this
            ->actingAs($author, 'api')
            ->postJson(
                route('articles.store'),
                [
                    'content' => 'testing article',
                    'title' => 'test title'
                ]
            );

        $response->assertStatus(201);
        $articles = Article::all();
        $this->assertCount(1, $articles);
    }

    public function test_article_store_throws_error_when_not_authenticated(): void
    {

        $response = $this->postJson(
            route('articles.store'),
            [
                'content' => 'foobar',
                'title' => 'title'
            ]
        );

        $response->assertStatus(401);
        $comments = Article::all();
        $this->assertEmpty($comments);
    }

    public function test_article_store_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        $response = $this
            ->actingAs($author, 'api')
            ->postJson(
                route('articles.store'),
                [
                    'content' => 'testing article',
                    'title' => 'test title'
                ]
            );

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['title', 'content']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'title' => 'test title',
                'content' => 'testing article',
            ],
        ]);
    }

    public function test_article_store_throws_error_when_not_authenticated_with_debug_middleware(): void
    {
        $response = $this
            ->postJson(
                route('articles.store'),
                [
                    'content' => 'foobar',
                    'title' => 'title'
                ]
            );

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['title', 'content']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'foobar',
                'title' => 'title',
            ],
        ]);
    }
}
