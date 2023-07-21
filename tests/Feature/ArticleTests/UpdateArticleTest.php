<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    public function test_article_update(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $article = Article::factory()
            ->set('author_id', $author->id)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('articles.update', [$article->id]),
                [
                    'content' => 'update article',
                    'title' => 'test title'
                ]
            );

        $response->assertStatus(200);
        $article->refresh();
        $this->assertEquals('update article', $article->content);
        $this->assertEquals('test title', $article->title);
    }

    public function test_article_update_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $article = Article::factory()
            ->set('author_id', $author->id)
            ->createOne();

        $response = $this->patchJson(
            route('articles.update', [$article->id]),
            [
                'content' => 'update article',
                'title' => 'test title'
            ]
        );

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['content', 'title']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'update article',
                'title' => 'test title',
            ],
        ]);
    }

    public function test_article_update_throws_error_when_not_authenticated(): void
    {
        $article = Article::factory()->createOne();

        $response = $this->patchJson(
            route('articles.update',  [$article->id]),
            [
                'title' => 'update title',
                'content' => 'update article'
            ]
        );

        $response->assertStatus(401);
    }

    public function test_article_update_throws_error_when_not_able_to_update_other_person_article(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->set('id', 10)
            ->createOne();
        $article = Article::factory()
            ->set('author_id', 2)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('articles.update', [$article->id]),
                [
                    'title' => 'update title',
                    'content' => 'update content'
                ]
            );

        $response->assertStatus(403);
    }
}
