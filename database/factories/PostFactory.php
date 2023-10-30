<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $title = fake()->sentence();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => function() {
            //     return \App\Models\User::factory()->create()->id;
            // },
            'author' => fake()->name(),
            'title' => $title,
            'slug' => $title,
            'summary' => fake()->realText(),
            'body' => fake()->realText($minNbChars = 2000, $indexSize = 2),
        ];
    }
}
