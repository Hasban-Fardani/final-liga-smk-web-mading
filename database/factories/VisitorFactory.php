<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'user_id' => fake()->numberBetween(1, 30),
            'slug' => fake()->randomElement(['home', 'post1', 'post2', 'post3']),
            'visited_at' => now(),
        ];
    }
}
