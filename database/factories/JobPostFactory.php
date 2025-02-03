<?php

namespace Database\Factories;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostFactory extends Factory
{
    protected $model = JobPost::class;

    public function definition(): array
    {
        return [
            'job_title' => $this->faker->jobTitle(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'about_job' => $this->faker->paragraph(),
            'job_tasks' => $this->faker->sentence(),
            'job_conditions' => $this->faker->sentence(),        
            'job_skills' =>$this->faker->words(5),
            'job_location' => $this->faker->city(),
            'job_timing' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Remote']),
            'tags' => $this->faker->words(3), // بدون `json_encode()`
            'target' => $this->faker->randomElement(['to_any_one', 'connection_only']),
            'is_active' => $this->faker->boolean(),
            'job_post' => now(), // تاريخ النشر
            'views' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
