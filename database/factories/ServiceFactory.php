<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ServiceName' => $this->faker->sentence,
            'ServiceCategoryID' => $this->faker->numberBetween(1, 5), // Assuming you have 10 service categories seeded
            'Price' => $this->faker->numberBetween(10, 100),
            'TimeDurationHours' => $this->faker->numberBetween(0, 3),
            'TimeDurationMinutes' => $this->faker->numberBetween(0, 59),
            'ShortDescription' => $this->faker->sentence,
            'ServiceProviderID' => $this->faker->numberBetween(1, 5), // Assuming you have 20 service providers seeded
        ];
    }
}
