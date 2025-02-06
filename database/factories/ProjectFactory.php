<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->text(500), // Max 500 characters
            'contributions' => $this->faker->text(1000), // Max 1000 characters
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
