<?php

namespace Database\Seeders;

use App\Models\FuelStation;
use App\Models\RepairShop;
use Illuminate\Database\Seeder;

class FuelStationAndRepairShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FuelStation::factory()
            ->count(10)
            ->create();

        RepairShop::factory()
            ->count(10)
            ->create();
    }
}
