<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffCategory>
 */
class StaffCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'StaffID' => $this->faker->numberBetween(1, 50), // Assuming you have 50 staff members seeded
            'ServiceCategoryID' => $this->faker->numberBetween(1, 10), // Assuming you have 10 service categories seeded
        ];
    }
}
