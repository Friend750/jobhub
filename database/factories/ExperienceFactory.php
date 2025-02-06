<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
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
            'job_title' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'description' => $this->faker->sentence(12),
            'location' => $this->faker->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
