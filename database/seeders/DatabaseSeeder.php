<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Instructor;
use App\Models\Producto;
use App\Models\TipoMembresia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Teffi',
            'email' => 'teffy@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Cliente::factory(30)->create();
        Instructor::factory(10)->create();
        Equipo::factory(20)->create();
        Producto::factory(10)->create();
        TipoMembresia::factory(5)->create();
    }
}
