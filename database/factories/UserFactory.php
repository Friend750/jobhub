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
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTime,
            'user_name' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), // You can use Hash::make if needed
            'user_image' => $this->faker->optional()->imageUrl(200, 200, 'people'),
            'type' => $this->faker->randomElement(['admin', 'user', 'company']),
            'professional_summary' => $this->faker->optional()->paragraphs(3, true),
            'is_active' => $this->faker->boolean(80), // 80% chance of being true
            'is_connected' => $this->faker->boolean(20), // 20% chance of being true
            'remember_token' => Str::random(10),
        ];
    }    /**
         * Indicate that the model's email address should be unverified.
         */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
