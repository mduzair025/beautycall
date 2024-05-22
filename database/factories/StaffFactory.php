<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->firstName,
            'Surname' => $this->faker->lastName,
            'Email' => $this->faker->unique()->safeEmail,
            'PhoneNumber' => $this->faker->phoneNumber,
            'ServiceProviderID' => $this->faker->numberBetween(1, 10), // Assuming you have 20 service providers seeded
            'ImageName' => $this->faker->imageUrl(), // Example image URL
        ];
    }
}
