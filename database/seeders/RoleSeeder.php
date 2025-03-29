<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'fleet_manager']); // gestor da frota
        Role::firstOrCreate(['name' => 'unit_manager']);  // gestor da unidade
        Role::firstOrCreate(['name' => 'garage_manager']);
        Role::firstOrCreate(['name' => 'driver']);
    }
}
