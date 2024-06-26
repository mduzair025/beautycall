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
    public function definition(): array
    {
        return [
            'Name' => $this->faker->firstName,
            'Surname' => $this->faker->firstName,
            'Username' => $this->faker->unique()->userName,
            'email_verified_at' => now(),
            'Password' => static::$password ??= Hash::make('password'), // Default password
            'Country' => $this->faker->country,
            'City' => $this->faker->city,
            'Address' => $this->faker->address,
            'PostalCode' => $this->faker->postcode,
            'Email' => fake()->unique()->safeEmail(), // Specific email
            'PhoneNumber' => $this->faker->phoneNumber,
            'UserImageName' => null,
            'remember_token' => Str::random(10),
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
