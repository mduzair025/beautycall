<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProviderRating>
 */
class ServiceProviderRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ServiceProviderID' => $this->faker->numberBetween(1, 10), // Assuming you have 20 service providers seeded
            'BookingRatingID' => $this->faker->numberBetween(1, 10), // Assuming you have 50 booking ratings seeded
        ];
    }
}
