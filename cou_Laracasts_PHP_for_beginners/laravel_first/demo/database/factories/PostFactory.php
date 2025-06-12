<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        return [
            
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'author' => \App\Models\User::factory(), // Assuming you have a UserFactory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
