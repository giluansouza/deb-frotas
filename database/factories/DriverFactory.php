<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected $model = \App\Models\Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'rg' => $this->faker->numerify('##########'),
            'number_cnh' => $this->faker->numerify('###########'),
            'category_cnh' => $this->faker->randomElement(['A', 'B', 'AB', 'C', 'D', 'E']),
            'first_cnh' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'validity_cnh' => $this->faker->dateTimeBetween('now', '+5 years'),
            'register' => $this->faker->uuid(),
            'link' => $this->faker->url(),
        ];
    }
}
