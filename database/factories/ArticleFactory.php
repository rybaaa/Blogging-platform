<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $content = collect();
        for ($i = 0; $i < 10; $i++) {
            $content->push($this->faker->paragraph());
        }

        return [
            'title' => $this->faker->sentence(),
            'content' => $content->implode("\n\n"),
            'author_id' => User::factory(),
            'premium' => $this->faker->randomElement([true, false]),
        ];
    }
}
