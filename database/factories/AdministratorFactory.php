<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'AdministratorName' => $this->faker->firstName,
            'AdministratorSurname' => $this->faker->lastName,
            'Username' => $this->faker->userName,
            'Password' => bcrypt('12345678'), // Default password
            'Country' => $this->faker->country,
            'City' => $this->faker->city,
            'Address' => $this->faker->address,
            'PostalCode' => $this->faker->postcode,
            'Email' => fake()->unique()->safeEmail(), // Specific email
            'PhoneNumber' => $this->faker->phoneNumber,
            'AdministratorImage' => $this->faker->imageUrl(), // Example image URL
        ];
    }
}
