<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
