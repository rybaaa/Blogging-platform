<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    public function test_article_update(): void
    {
        $article = Article::factory()->createOne();

        $response = $this->patch(route('articles.update', [$article->id]),
    [
        'content' => 'update article',
        'title' => 'test title'
    ]);

        $response->assertStatus(204);
        $article->refresh();
        $this->assertEquals('update article', $article->content);
        $this->assertEquals('test title', $article->title);
    }
}
