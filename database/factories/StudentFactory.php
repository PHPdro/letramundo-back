<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(4, 10),
            'year' => fake()->numberBetween(1, 5),
            'class' => fake()->randomElement(['A', 'B', 'C']),
            'user_id' => \App\Models\User::factory(),
            'theme_id' => \App\Models\Theme::factory(),
        ];
    }
}
