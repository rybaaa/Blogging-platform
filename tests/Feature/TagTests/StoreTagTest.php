<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTagTest extends TestCase
{
    public function test_tag_store(): void
    {
        $author = User::factory()
            ->set('email', 'test@test.com')
            ->set('password', '12345678')
            ->createOne();

        $response = $this
            ->actingAs($author)
            ->postJson(
                route('tags.store'),
                [
                    'title' => 'test tag'
                ]
            );

        $response->assertStatus(201);
        $tags = Tag::all();
        $createdTag = Tag::where('title', 'test tag')->firstOrFail();
        $this->assertCount(1, $tags);
        $this->assertEquals($createdTag->title, 'test tag');
    }

    public function test_tag_store_with_debug_middleware(): void
    {
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();

        $response = $this
            ->actingAs($author)
            ->postJson(
                route('tags.store'),
                [
                    'title' => 'test tag'
                ]
            );

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'debug-info' => [
                'execution-time-milliseconds',
                'requested-get-parameters' => [],
                'requested-post-body' => ['title']
            ],
        ]);
        $response->assertJsonFragment([
            'requested-post-body' => [
                'title' => 'test tag',
            ],
        ]);
    }

    public function test_tag_store_throws_error_when_not_authenticated(): void
    {
        $response = $this->postJson(
            route('tags.store'),
            [
                'title' => 'php',
            ]
        );

        $response->assertStatus(401);
        $tags = Tag::all();
        $this->assertEmpty($tags);
    }
}
