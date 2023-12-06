<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $titles = ['adventure', 'travel', 'technology', 'fashion', 'branding'];
        shuffle($titles);

        return [
            'title' => array_shift($titles),
            'author_id' => User::factory(),
        ];
    }
}
