<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poli>
 */
class PoliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(), // Menghasilkan nama poli
            'biaya' => $this->faker->numberBetween(10000, 500000), // Menghasilkan biaya antara 10.000 hingga 500.000
            'keterangan' => $this->faker->sentence(), // Menghasilkan keterangan
        ];
    }
}
