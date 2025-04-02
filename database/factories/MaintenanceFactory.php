<?php

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\RepairShop;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicleId = Vehicle::inRandomOrder()->value('id');
        $repairShopId = RepairShop::inRandomOrder()->value('id');
        $authorizedBy = User::inRandomOrder()->value('id');

        $startDate = $this->faker->dateTimeBetween('-2 months', '-1 weeks');

        $status = $this->faker->randomElement(['pending', 'in_progress', 'completed']);

        $endDate = $status === 'completed' ? $this->faker->dateTimeBetween($startDate, 'now') : null;

        $invoiceNumber = $status === 'completed' ? $this->faker->numerify('###-###') : null;
        $invoiceDate = $status === 'completed' ? $this->faker->dateTimeBetween($startDate, 'now') : null;

        return [
            'vehicle_id' => $vehicleId,
            'repair_shop_id' => $repairShopId,
            'authorized_by' => $authorizedBy,
            'type' => $this->faker->randomElement(['preventive', 'corrective']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'odometer' => $this->faker->numberBetween(10000, 99999),
            'problem_description' => $this->faker->text,
            'solution_description' => $status === 'completed' ? $this->faker->text : null,
            'cost' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $status,
            'invoice_number' => $invoiceNumber,
            'invoice_date' => $invoiceDate,
        ];
    }
}
