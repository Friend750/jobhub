<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'course_name' => $this->faker->randomElement([
                'Web Development Bootcamp',
                'Data Science Fundamentals',
                'Project Management Professional',
                'Machine Learning with Python',
                'Full Stack Development'
            ]),
            'institution_name' => $this->faker->company . ' Academy',
            'end_date' => $this->faker->date(), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
