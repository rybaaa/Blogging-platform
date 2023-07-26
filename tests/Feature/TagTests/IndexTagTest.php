<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTagTest extends TestCase
{
    public function test_tag_index(): void
    {
        $tags = Tag::factory()->count(5)->create();

        $response = $this->get(route('tags.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.data');
    }

    public function test_tag_index_with_debug_middleware(): void
    {
        $response = $this->get(route('tags.index'));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_tag_index_with_pagination(): void
    {
        Tag::factory()->count(100)->create();

        $response = $this->get(route('tags.index'));

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
    }
}
