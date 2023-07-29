<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTagTest extends TestCase
{
    public function test_tag_show(): void
    {
        $tag = Tag::factory()
            ->set('id', 10)
            ->set('title', 'laravel')
            ->createOne();
        Tag::factory()->count(5)->create();

        $response = $this->get(route('tags.show', [$tag->id]));
        $response->assertStatus(200);
        $this->assertEquals('laravel', $tag->title);
    }

    public function test_tag_show_with_debug_middleware(): void
    {
        $tag = Tag::factory()
            ->set('id', 100)
            ->set('title', 'laravel')
            ->createOne();
        Tag::factory()->count(5)->create();

        $response = $this->get(route('tags.show', [$tag->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }
}
