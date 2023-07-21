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

        $response->assertStatus(200);
        $article->refresh();
        $this->assertEquals('update article', $article->content);
        $this->assertEquals('test title', $article->title);
    }

    public function test_article_update_with_debug_middleware(): void
    {
        $article = Article::factory()->createOne();

        $response = $this->patch(route('articles.update', [$article->id]),
    [
        'content' => 'update article',
        'title' => 'test title'
    ]);

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>['content', 'title']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'content' => 'update article',
                'title' => 'test title',
            ],
        ]);
    }
}
