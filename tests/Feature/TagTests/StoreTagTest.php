<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTagTest extends TestCase
{
    public function test_tag_store(): void
    {
        $response = $this->postJson(route('tags.store'),
    [
        'title' => 'test tag'
    ]);

        $response->assertStatus(201);
        $tags = Tag::all();
        $createdTag = Tag::where('title', 'test tag')->firstOrFail();
        $this->assertCount(1, $tags);
        $this->assertEquals( $createdTag->title, 'test tag');
    }

    public function test_tag_store_with_debug_middleware():void 
    {
        $response = $this->postJson(route('tags.store'),
    [
        'title' => 'test tag'
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
                'title' => 'test tag',
            ],
        ]);
    }
}
