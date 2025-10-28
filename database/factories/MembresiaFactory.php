<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membresia>
 */
class MembresiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->date(),
            'estado' => fake()->randomElement(['pendiente', 'activo', 'cancelado']),
            'precio_pagado' => fake()->randomElement([200,159, 100, 4]),
            'tipomembresia_id' => fake()->randomElement([1,2,3,4]),
            'cliente_id' => fake()->randomElement([1,2,3,4])
        ];
    }
}
