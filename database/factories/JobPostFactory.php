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
            'job_conditions' => $this->faker->sentence(),  // تم إزالة التكرار هنا
            'job_skills' => json_encode($this->faker->words(5)),  // استخدام json_encode هنا
            'job_location' => $this->faker->city(),
            'job_timing' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Remote']),
            'tags' => json_encode($this->faker->words(3)),  // تم اختيار json_encode هنا
            'target' => $this->faker->randomElement(['to_any_one', 'connection_only']) ?? 'to_any_one',
            'job_post' => now(), // تاريخ النشر
            'views' => $this->faker->numberBetween(0, 1000),
        ];
        
    }
}