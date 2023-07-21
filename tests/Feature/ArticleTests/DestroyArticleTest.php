<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyArticleTest extends TestCase
{
    public function test_article_destroy(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $article = Article::factory()
            ->set('author_id', $author->id)
            ->set('id', 10)
            ->createOne();
        Article::factory()->count(5)->create();

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('articles.destroy', [$article->id]));

        $response->assertStatus(200);
        $updatedArticles = Article::all();
        $this->assertCount(5, $updatedArticles);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    public function test_article_destroy_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $article = Article::factory()
            ->set('author_id', $author->id)
            ->set('id', 5)
            ->createOne();
        Article::factory()->count(5)->create();

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('articles.destroy', [$article->id]));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_article_destroy_throws_error_when_not_authenticated(): void
    {
        $article = Article::factory()->createOne();

        $response = $this->deleteJson(
            route('articles.destroy',  [$article->id])
        );

        $response->assertStatus(401);
    }

    public function test_article_destroy_throws_error_when_not_able_to_delete_other_person_article(): void
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
            ->deleteJson(route('articles.destroy', [$article->id]));

        $response->assertStatus(403);
    }
}
