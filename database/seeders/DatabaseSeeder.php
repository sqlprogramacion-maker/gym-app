<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Instructor;
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
            'name' => 'Luis Foronda',
            'email' => 'luis@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Cliente::factory(30)->create();
        Instructor::factory(10)->create();
    }
}
