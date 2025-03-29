<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Fueling;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fleetManager = User::role('fleet_manager')->first() ?? User::factory()->create()->assignRole('fleet_manager');

        $vehicles = Vehicle::count() ? Vehicle::all() : Vehicle::factory()->count(5)->create();
        $drivers = Driver::count() ? Driver::all() : Driver::factory()->count(5)->create();

        foreach (range(1, 10) as $i) {
            Fueling::factory()->create([
                'vehicle_id' => $vehicles->random()->id,
                'driver_id' => $drivers->random()->id,
                'authorized_by' => $fleetManager->id,
            ]);
        }

        $this->command->info('✅ Seed de abastecimentos finalizado com sucesso!');
    }
}
