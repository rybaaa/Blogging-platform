<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response->assertStatus(204);
        $tags = Tag::all();
        $createdTag = Tag::where('title', 'test tag')->firstOrFail();
        $this->assertCount(1, $tags);
        $this->assertEquals( $createdTag->title, 'test tag');
    }
}
