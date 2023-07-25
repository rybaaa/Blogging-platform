<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTagTest extends TestCase
{
    public function test_tag_update(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', $author->id)
            ->set('id', 1)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('tags.update', [$tag->id]),
                [
                    'title' => 'update tag'
                ]
            );

        $response->assertStatus(200);
        $tag->refresh();
        $tags = Tag::all();
        $this->assertCount(1, $tags);
        $this->assertEquals('update tag', $tag->title);
    }

    public function test_tag_update_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', $author->id)
            ->set('id', 1)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('tags.update', [$tag->id]),
                [
                    'title' => 'update tag'
                ]
            );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['title']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'title' => 'update tag',
            ],
        ]);
    }

    public function test_tag_update_throws_error_when_not_authenticated(): void
    {
        $comment = Tag::factory()->createOne();

        $response = $this->patchJson(
            route('tags.update',  [$comment->id]),
            [
                'title' => 'update tag'
            ]
        );

        $response->assertStatus(401);
    }

    public function test_tag_update_throws_error_when_not_able_to_update_other_person_tag(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->set('id', 10)
            ->createOne();
        $tag = Tag::factory()
            ->set('author_id', 2)
            ->createOne();

        $response = $this
            ->actingAs($author, 'api')
            ->patchJson(
                route('tags.update', [$tag->id]),
                [
                    'title' => 'update tag'
                ]
            );
        $response->assertStatus(403);
    }
}
