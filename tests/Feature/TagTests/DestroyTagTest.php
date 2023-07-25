<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTagTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_tag_destroy(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', $author->id)
            ->set('id', 10)
            ->createOne();
        Tag::factory()->count(5)->create();

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('tags.destroy', [$tag->id]));

        $response->assertStatus(200);
        $updatedTags = Tag::all();
        $this->assertCount(5, $updatedTags);
        $this->assertDatabaseMissing('tags', ['id' => 10]);
    }

    public function test_tag_destroy_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', $author->id)
            ->set('id', 5)
            ->createOne();
        Tag::factory()->count(5)->create();

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('tags.destroy', [$tag->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => []
            ],
        ]);
    }

    public function test_tag_destroy_throws_error_when_not_authenticated(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->deleteJson(
            route('tags.destroy',  [$tag->id])
        );

        $response->assertStatus(401);
    }

    public function test_tag_destroy_throws_error_when_not_able_to_delete_other_person_tag(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->set('id', 100)
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', 2)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->deleteJson(route('tags.destroy', [$tag->id]));

        $response->assertStatus(403);
    }
}
