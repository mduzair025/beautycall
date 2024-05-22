<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->company,
            'Country' => $this->faker->country,
            'City' => $this->faker->city,
            'Address' => $this->faker->address,
            'PostalCode' => $this->faker->postcode,
            'ShortDescription' => $this->faker->sentence,
            'Email' => $this->faker->unique()->safeEmail,
            'PhoneNumber' => $this->faker->phoneNumber,
            'AverageSalonRating' => $this->faker->numberBetween(1, 5),
            'AdministratorID' => $this->faker->numberBetween(1, 10), // Assuming you have 10 administrators seeded
            'OpeningTimeID' => $this->faker->numberBetween(1, 10), // Assuming you have 10 opening times seeded
            'Status' => $this->faker->randomElement(['Confirmed']),
            'RatingsNumber' => $this->faker->numberBetween(0, 10),
        ];
    }
}
