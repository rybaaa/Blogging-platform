<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTagTest extends TestCase
{
    public function test_tag_update(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->patch(route('tags.update', [$tag->id]),
    [
        'title' => 'update tag'
    ]);

        $response->assertStatus(200);
        $tag->refresh();
        $tags = Tag::all();
        $this->assertCount(1, $tags);
        $this->assertEquals('update tag', $tag->title);
    }

    public function test_tag_update_with_debug_middleware(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->patch(route('tags.update', [$tag->id]),
    [
        'title' => 'update tag'
    ]);

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>['title']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'title' => 'update tag',
            ],
        ]);
    }
}
