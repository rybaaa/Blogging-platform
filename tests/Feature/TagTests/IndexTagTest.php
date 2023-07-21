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
        $response->assertJsonCount(5, 'data');
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
}
