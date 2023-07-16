<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    public function test_article_index(): void
    {
        $articles = Article::factory()->count(5)->create();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $this->assertCount(5, $articles);
    }

    public function test_article_index_with_debug_middleware(): void
    {
        $response = $this->get(route('articles.index'));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>[]
            ],
        ]);
    }
}
