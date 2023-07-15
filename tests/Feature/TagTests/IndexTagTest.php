<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTagTest extends TestCase
{
    public function test_tag_index(): void
    {
        $tags = Tag::factory()->count(5)->create();

        $response = $this->get(route('tags.index'));

        $response->assertStatus(200);
        $this->assertCount(5, $tags);
    }
}
