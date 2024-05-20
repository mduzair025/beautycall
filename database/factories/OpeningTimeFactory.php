<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OpeningTime>
 */
class OpeningTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Monday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Tuesday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Wednesday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Thursday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Friday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Saturday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'Sunday' => $this->faker->randomElement(['09:00-17:00', '10:00-18:00', '11:00-19:00']),
            'AdministratorID' => $this->faker->numberBetween(1, 10), // Assuming you have 10 administrators seeded
        ];
    }
}
