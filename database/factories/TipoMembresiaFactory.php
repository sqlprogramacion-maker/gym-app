<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoMembresia>
 */
class TipoMembresiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'meses' => fake()->randomDigit(1, 12),
            'precio' => fake()->randomFloat(2, 50, 500),
            'beneficios' => fake()->paragraph(),
        ];
    }
}
