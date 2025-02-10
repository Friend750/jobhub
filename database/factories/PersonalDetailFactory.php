<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalDetail>
 */
class PersonalDetailFactory extends Factory
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
            'page_name' => $this->faker->optional()->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'specialist' => $this->faker->jobTitle,
            'professional_summary' => $this->faker->paragraph(3),
            'phone' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'website_name' => $this->faker->domainName,
            'link' => $this->faker->url,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
