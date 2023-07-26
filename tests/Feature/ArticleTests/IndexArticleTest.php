<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
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
}
