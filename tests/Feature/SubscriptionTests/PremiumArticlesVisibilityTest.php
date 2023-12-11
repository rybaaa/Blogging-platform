<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\PremiumArticlesTestCase;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Article;

class PremiumArticlesVisibilityTest extends PremiumArticlesTestCase
{

    public function test_subscribed_user_can_see_premium_articles(): void
    {
        $user = User::factory()->createOne();

        $response = $this
            ->actingAs($user)
            ->postJson(
                '/api/subscriptions',
                [
                    'name' => 'New',
                    'surname' => 'New',
                    'subscription_plan_id' => '1',
                    'credit_card_number' => '4242424242424242',
                    'cvv' => '845',
                    'expiry_date' => '12/25',
                    'address' => '',
                ]
            );

        Article::query()->delete();

        $articles = Article::factory(5)->create(['premium' => true]);

        $fetchArticles = $this->actingAs($user)->getJson('/api/premium-articles');

        $fetchArticles->assertStatus(200);

        $totalPremiumArticles = count($articles);
        $this->assertEquals($totalPremiumArticles, $fetchArticles->json('data.total'));

        $firstArticleTitle = $articles[0]->title;
        $fetchArticles->assertJsonFragment(['title' => $firstArticleTitle]);
    }


    public function test_unsubscribed_user_cannot_see_premium_articles(): void
    {
        $user = User::factory()->createOne();

        Article::query()->delete();

        $articles = Article::factory(5)->create(['premium' => true]);

        $response = $this->actingAs($user)->getJson('/api/premium-articles');

        $response->assertStatus(404);
        $response->assertSee('User is not subscribed');
    }


    public function test_unsubscribed_user_cannot_see_the_whole_premium_article(): void
    {
        $user = User::factory()->createOne();

        Article::query()->delete();

        $article = Article::factory()->createOne(['premium' => true]);

        $response = $this->actingAs($user)->getJson("/api/articles/{$article->id}");

        $limitedArticle = $response->json('data.content');

        $this->assertNotEquals($article->content, $limitedArticle);
    }


    public function test_subscribed_user_can_see_the_whole_premium_article(): void
    {
        $user = User::factory()->createOne(['is_subscriber' => 'true']);

        Article::query()->delete();

        $article = Article::factory()->createOne(['premium' => true]);

        $response = $this->actingAs($user)->getJson("/api/articles/{$article->id}");

        $responseArticle = $response->json('data.content');

        $this->assertEquals($article->content, $responseArticle);
    }
}
