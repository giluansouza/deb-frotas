<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RepairShop>
 */
class RepairShopFactory extends Factory
{
    private function fakeCnpj(): string
    {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = 0;
        $n10 = 0;
        $n11 = 0;
        $n12 = 1;

        return sprintf(
            '%d%d.%d%d%d.%d%d%d/%d%d%d%d-%02d',
            $n1,
            $n2,
            $n3,
            $n4,
            $n5,
            $n6,
            $n7,
            $n8,
            $n9,
            $n10,
            $n11,
            $n12,
            rand(10, 99)
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Oficina',
            'cnpj' => $this->fakeCnpj(),
            'location' => $this->faker->address(),
            'specialties' => implode(', ', $this->faker->randomElements([
                'freio',
                'motor',
                'elétrica',
                'suspensão',
                'óleo',
                'climatização'
            ], rand(1, 3))),
            'is_active' => $this->faker->boolean(95),
            'created_by' => 1,
            'updated_by' => null,
        ];
    }
}
