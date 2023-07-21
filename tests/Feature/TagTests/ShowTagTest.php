<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTagTest extends TestCase
{
    public function test_tag_show(): void
    {
        $this->postJson(route('tags.store'),
    [
        'title' => 'laravel'
    ]);


        $tags = Tag::all();
        $requiredTag = Tag::where('title', 'laravel')->firstOrFail();

        $response = $this->get(route('tags.show', [$requiredTag->id]));

        $response->assertStatus(200);
        $this->assertCount(1, $tags);
        $this->assertEquals( 'laravel', $requiredTag->title);
    }

    public function test_tag_show_with_debug_middleware():void 
    {
        $this->postJson(route('tags.store'),
    [
        'title' => 'laravel'
    ]);

        $requiredTag = Tag::where('title', 'laravel')->firstOrFail();

        $response = $this->get(route('tags.show', [$requiredTag->id]));

        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters'=>[],
                'requested-post-body'=>[]
            ],
        ]);

    }
}
