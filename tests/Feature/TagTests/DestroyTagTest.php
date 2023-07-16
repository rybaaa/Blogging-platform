<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTagTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_tag_destroy(): void
    {
        $this->postJson(route('tags.store'),
    [
        'title' => 'laravel'
    ]);

        $requiredTag = Tag::where('title', 'laravel')->firstOrFail();

        $response = $this->delete(route('tags.destroy', [$requiredTag->id]));

        $response->assertStatus(204);
        $updatedTags = Tag::all();
        $this->assertEmpty($updatedTags);
        $this->assertDatabaseMissing('tags', ['title' => 'laravel']);
    }

    public function test_tag_destroy_with_debug_middleware(): void
    {
        $this->postJson(route('tags.store'),
    [
        'title' => 'laravel'
    ]);

        $requiredTag = Tag::where('title', 'laravel')->firstOrFail();

        $response = $this->delete(route('tags.destroy', [$requiredTag->id]));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>[]
            ],
        ]);
    }
}
