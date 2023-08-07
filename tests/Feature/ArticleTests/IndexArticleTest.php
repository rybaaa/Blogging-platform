<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    public function test_article_index(): void
    {
        Article::factory()->count(5)->create();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.data');
    }

    public function test_article_index_with_debug_middleware(): void
    {
        $response = $this->get(route('articles.index'));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_article_index_with_pagination(): void
    {
        Article::factory()->count(20)->create();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data.data');
        $response->assertJsonStructure([
            'data' => [
                'current_page',
                'data',
                'from',
                'last_page',
                'next_page_url',
                'per_page',
                'total'
            ]
        ]);

        $responseData = $response->json();
        $nextPage = $responseData['data']['next_page_url'];

        $nextResponse = $this->get($nextPage);

        $nextResponse->assertJsonCount(5, 'data.data');
    }

    public function test_article_index_with_filtering(): void
    {
        $article1 = Article::factory()
            ->set('author_id', 888)
            ->createOne();
        $article2 = Article::factory()
            ->set('author_id', 888)
            ->createOne();

        $this->assertDatabaseCount('articles', 2);

        $response = $this->getJson(
            route(
                'articles.index',
                ['author_id' => 888]
            )
        );

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data.data');
    }
}
