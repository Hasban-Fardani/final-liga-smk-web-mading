<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accepted = fake()->boolean();
        return [
            //
            'image' => fake()->imageUrl(),
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'body' => fake()->text(),
            'accepted' => $accepted,
            'status' => $accepted ? 'PUBLISHED' : fake()->randomElement(['DRAFT', 'PENDING']),
            'published_at' => fake()->dateTimeBetween('-1 year', '+1 day'),
            'views' => fake()->numberBetween(0, 1000),
            'creator_id' => fake()->numberBetween(1, 2),
            'category_id' => fake()->numberBetween(1, 4)
        ];
    }
}
