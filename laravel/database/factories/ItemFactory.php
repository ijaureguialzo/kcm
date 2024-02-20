<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(),
            'description' => fake()->text(),
            'content' => fake()->text(),
            'url' => fake()->url(),
            'uid' => fake()->uuid(),
            'published' => now(),
            'feed_id' => Feed::factory()->create(),
        ];
    }
}
