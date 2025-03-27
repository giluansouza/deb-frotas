<?php

namespace Database\Seeders;

use App\Models\Driver;
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
        Driver::factory(10)->create();
        Vehicle::factory(10)->create();
    }
}
