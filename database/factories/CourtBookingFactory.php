<?php

namespace Database\Factories;

use App\Models\Court;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourtBooking>
 */
class CourtBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'court_id' => Court::inRandomOrder()->pluck('id')->first(),
            'customer_id' => Customer::inRandomOrder()->pluck('id')->first(),
            'hour' => $this->faker->randomDigit(2),
            'total_player' => $this->faker->randomDigit(2),
            'total_price' => $this->faker->randomDigit(),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
        ];
    }
}
