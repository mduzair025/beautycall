<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'BeginTime' => $this->faker->time(),
            'Date' => $this->faker->date(),
        'BookingStatus' => $this->faker->randomElement(['Booked', 'Finished', 'Refused']),
            'ServiceProviderID' => $this->faker->numberBetween(1, 20), // Assuming you have 20 service providers seeded
            'ServiceID' => $this->faker->numberBetween(1, 100), // Assuming you have 100 services seeded
            'BookingRatingID' => $this->faker->numberBetween(1, 50), // Assuming you have 50 booking ratings seeded
            'UserID' => $this->faker->numberBetween(1, 100), // Assuming you have 100 users seeded
            'FinishTime' => $this->faker->time(),
            'StaffID' => $this->faker->numberBetween(1, 50), // Assuming you have 50 staff members seeded
            'Deleted' => null,
        ];
    }
}
