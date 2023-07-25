<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    public function test_article_show(): void
    {
        $article = Article::factory()
            ->set('id', 10)
            ->set('title', 'article title')
            ->createOne();
        Article::factory()->count(5)->create();

        $response = $this->get(route('articles.show', [$article->id]));

        $response->assertStatus(200);
        $this->assertEquals('article title', $article->title);
    }

    public function test_article_show_with_debug_middleware(): void
    {
        $article = Article::factory()
            ->set('id', 10)
            ->set('title', 'article title')
            ->createOne();
        Article::factory()->count(5)->create();

        $response = $this->get(route('articles.show', [$article->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }
}
