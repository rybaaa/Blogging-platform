<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    public function test_article_show(): void
    {
        $articles = Article::factory()->count(5)->create();
        $requiredArticle = $articles[0];

        $response = $this->get(route('articles.show', [$requiredArticle->id]));

        $response->assertStatus(200);
        $this->assertCount(5, $articles);
        $this->assertEquals( $requiredArticle->id, $articles[0]->id);
    }
}
