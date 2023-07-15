<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response->assertStatus(204);
        $tag->refresh();
        $tags = Tag::all();
        $this->assertCount(1, $tags);
        $this->assertEquals('update tag', $tag->title);
    }
}
