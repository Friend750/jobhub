<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_name' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'is_admin' => $this->faker->boolean(20), // 20% chance of being admin
            'password' => bcrypt('password'), // or use Hash::make('password') if you prefer
            'user_image' => $this->faker->optional()->imageUrl(100, 100, 'people', true, 'Faker'), // can be null
            'professional_summary' => $this->faker->sentence(15), // 15-word summary
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
