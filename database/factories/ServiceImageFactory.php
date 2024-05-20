<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceImage>
 */
class ServiceImageFactory extends Factory
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
            'ServiceID' => $this->faker->numberBetween(1, 100), // Assuming you have 100 services seeded
        ];
    }
}
