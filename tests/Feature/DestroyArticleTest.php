<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyArticleTest extends TestCase
{
    public function test_article_destroy(): void
    {
        $articles = Article::factory()->count(5)->create();
        $requiredArticle = $articles[0];

        $response = $this->delete(route('articles.destroy', [$requiredArticle->id]));

        $response->assertStatus(204);
        $updatedArticles = Article::all();
        $this->assertCount(4, $updatedArticles);
        $this->assertDatabaseMissing('articles', ['id' => $requiredArticle->id]);
    }
}
