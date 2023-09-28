<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => function() {
            //     return \App\Models\User::factory()->create()->id;
            // },
            'author' => fake()->name(),
            'title' => fake()->sentence(),
            'summary' => fake()->realText(),
            'body' => fake()->realText($minNbChars = 2000, $indexSize = 2),
        ];
    }
}
