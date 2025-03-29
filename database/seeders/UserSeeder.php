<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@frotas.test'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('123456')
            ]
        );
        $admin->assignRole('admin');

        // Gestor da Frota
        $fleetManager = User::firstOrCreate(
            ['email' => 'frota@frotas.test'],
            [
                'name' => 'Gestor da Frota',
                'password' => Hash::make('123456')
            ]
        );
        $fleetManager->assignRole('fleet_manager');

        // Gestor da Unidade
        $unitManager = User::firstOrCreate(
            ['email' => 'unidade@frotas.test'],
            [
                'name' => 'Gestor da Unidade',
                'password' => Hash::make('123456')
            ]
        );
        $unitManager->assignRole('unit_manager');

        // Responsável pela Garagem
        $garageManager = User::firstOrCreate(
            ['email' => 'garagem@frotas.test'],
            [
                'name' => 'Garage Manager',
                'password' => Hash::make('123456')
            ]
        );
        $garageManager->assignRole('garage_manager');

        // Motorista
        $driver = User::firstOrCreate(
            ['email' => 'motorista@frotas.test'],
            [
                'name' => 'Motorista',
                'password' => Hash::make('123456')
            ]
        );
        $driver->assignRole('driver');
    }
}
