<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = \App\Models\Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->randomElement(['VW', 'Fiat', 'Chevrolet', 'Ford', 'Volvo']),
            'model' => fake()->randomElement(['Gol', 'Uno', 'Onix', 'Fiesta', 'FH']),
            'plate' => fake()->unique()->regexify('[A-Z]{3}[0-9]{4}'),
            'year_model' => fake()->year(),
            'year_manufacture' => fake()->year(),
            'renavam' => fake()->numerify('###########'),
            'type' => fake()->randomElement(['Automóvel', 'Motocicleta', 'Caminhão', 'Ônibus', 'Utilitário']),
            'fuel_type' => fake()->randomElement(['Gasolina', 'Diesel', 'Etanol', 'Flex']),
            'tank_capacity' => fake()->numberBetween(40, 100),
            'ownership' => fake()->randomElement(['Próprio', 'Cedido', 'Locado']),
            'administrative_unit' => fake()->randomElement(['Saúde', 'Educação', 'Infraestrutura', 'Agricultura']),
            'conservation_state' => fake()->randomElement(['Bom', 'Regular', 'Ruim']),
            'visual_identity' => fake()->boolean(),
        ];
    }
}
