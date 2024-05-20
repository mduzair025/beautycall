<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingRating>
 */
class BookingRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'BookingRatingNumber' => $this->faker->numberBetween(1, 5),
            'UserID' => $this->faker->numberBetween(1, 100), // Assuming you have 100 users seeded
        ];
    }
}
