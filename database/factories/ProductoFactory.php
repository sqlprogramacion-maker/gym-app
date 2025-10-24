<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => fake()->paragraph(1),
            'precio' => fake()->randomFloat(2, 50, 500),
            'stock' => fake()->randomNumber(2),
            'marca' => fake()->name(),
            'fecha_vencimiento' => fake()->date()
        ];
    }
}
