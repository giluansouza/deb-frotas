<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fueling>
 */
class FuelingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $liters = $this->faker->randomFloat(2, 10, 80);
        $price_per_liter = $this->faker->randomFloat(2, 4, 7);
        $total_cost = $liters * $price_per_liter;

        return [
            'vehicle_id' => Vehicle::factory(),
            'driver_id' => Driver::factory(),
            'authorized_by' => User::factory(),
            'fueled_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'odometer_km' => $this->faker->numberBetween(10000, 100000),
            'liters' => $liters,
            'price_per_liter' => $price_per_liter,
            'total_cost' => $total_cost,
            'fuel_type' => $this->faker->randomElement(['Gasolina', 'Diesel', 'Etanol']),
            'fueling_station_name' => $this->faker->company(),
            'invoice_number' => $this->faker->optional()->numerify('NF###/2025'),
        ];
    }
}
