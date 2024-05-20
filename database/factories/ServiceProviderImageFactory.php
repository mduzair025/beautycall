<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProviderImage>
 */
class ServiceProviderImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ImageName' => $this->faker->imageUrl(), // Example image URL
            'ServiceProviderID' => $this->faker->numberBetween(1, 20), // Assuming you have 20 service providers seeded
        ];
    }
}
