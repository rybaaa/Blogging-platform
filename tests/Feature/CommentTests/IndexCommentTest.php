<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexCommentTest extends TestCase
{
    public function test_comment_index(): void
    {
        Comment::factory()->count(5)->create();

        $response = $this->get(route('comments.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.data');
    }

    public function test_comment_index_with_debug_middleware(): void
    {
        $response = $this->get(route('comments.index'));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_comment_index_with_pagination(): void
    {
        Comment::factory()->count(17)->create();

        $response = $this->get(route('comments.index'));

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

        $nextResponse->assertJsonCount(2, 'data.data');
    }
    public function test_comment_index_with_filtering(): void
    {
        $article1 = Article::factory()
            ->has(Comment::factory(5)->set('author_id', 888), 'comments')
            ->createOne();

        $article2 = Article::factory()
            ->has(Comment::factory(2)->set('author_id', 888), 'comments')
            ->createOne();

        $this->assertDatabaseCount('comments', 7);

        $response = $this->getJson(
            route(
                'comments.index',
                [
                    'article_id' => $article1->id,
                    'author_id' => 888
                ],
            )
        );

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.data');
    }
}
