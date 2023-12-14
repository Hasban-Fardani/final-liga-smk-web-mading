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
        $accepted = $this->faker->boolean();
        return [
            //
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->text(maxNbChars:20),
            'body' => $this->faker->text(),
            'accepted' => $accepted,
            'status' => $accepted ? 'PUBLISHED' : 'PENDING',
            'views' => $this->faker->numberBetween(0, 1000),
            'creator_id' => $this->faker->numberBetween(1, 2),
            'category_id' => $this->faker->numberBetween(1, 2)
        ];
    }
}
