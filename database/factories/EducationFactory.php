<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
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
            'institution_name' => $this->faker->company . ' University',
            'certification_name' => $this->faker->randomElement([
                'Bachelor of Science',
                'Master of Arts',
                'PhD in Engineering'
            ]),
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'degree' => $this->faker->randomElement([
                'Computer Science',
                'Business Administration',
                'Mechanical Engineering'
            ]),
            'description' => $this->faker->sentence(10),
            'graduation_date' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
