<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driverUsers = User::role('driver')->get();

        foreach ($driverUsers as $user) {
            Driver::factory()->create([
                'user_id' => $user->id,
                'name' => $user->name,
            ]);
        }

        Vehicle::factory(10)->create();
    }
}
