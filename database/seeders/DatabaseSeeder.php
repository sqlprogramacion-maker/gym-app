<?php

namespace Database\Seeders;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Instructor;
use App\Models\Membresia;
use App\Models\Producto;
use App\Models\TipoMembresia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'rol' => 'administrador',
            'password' => Hash::make('12345678'),
        ]);

        //Cliente::factory(30)->create();
        DB::table('clientes')->insert([
            [
                'nombre' => 'Maria Fernanda',
                'apellido' => 'Lopez Rojas',
                'edad' => 27,
                'peso' => 60,
                'carnet' => '9876543',
                'telefono' => '76543210',
                'talla' => 165,
                'user_id' => 1,
            ],
            [
                'nombre' => 'Sergio Manuel',
                'apellido' => 'Gutierrez Pinto',
                'edad' => 32,
                'peso' => 78,
                'carnet' => '8421596',
                'telefono' => '70123456',
                'talla' => 178,
                'user_id' => 1,
            ],
            [
                'nombre' => 'Sofia Alejandra',
                'apellido' => 'Vargas Flores',
                'edad' => 24,
                'peso' => 55,
                'carnet' => '9012345',
                'telefono' => '72987654',
                'talla' => 162,
                'user_id' => 1,
            ],
            [
                'nombre' => 'Magaly Mabel',
                'apellido' => 'Quiroga',
                'edad' => 29,
                'peso' => 82,
                'carnet' => '8732104',
                'telefono' => '71543219',
                'talla' => 170,
                'user_id' => 1,
            ],
            [
                'nombre' => 'Carla Jimena',
                'apellido' => 'Salazar Arce',
                'edad' => 35,
                'peso' => 68,
                'carnet' => '8543210',
                'telefono' => '74455667',
                'talla' => 170,
                'user_id' => 1,
            ]
        ]);

        //Instructor::factory(10)->create();

        DB::table('instructors')->insert([
            [
                'nombre' => 'Ericson Leonardo',
                'apellido' => 'Flores Ampuero',
                'especialidad' => 'entrenador, preparador de atletas y nutricionista',
                'celular' => '70123456',
                'carnet' => '8547210',
                'direccion' => 'Calle Murillo #245, Zona Central, La Paz',
            ],
            [
                'nombre' => 'Daniel Alejandro',
                'apellido' => 'Suarez Flores',
                'especialidad' => 'Zumba',
                'celular' => '71234567',
                'carnet' => '8694321',
                'direccion' => 'Av. Arce #1032, Sopocachi, La Paz',
            ],
            [
                'nombre' => 'Fernanda Lucia',
                'apellido' => 'Vargas Roca',
                'especialidad' => 'Cardio y resistencia',
                'celular' => '74567890',
                'carnet' => '8889751',
                'direccion' => 'Calle Linares #78, Zona Central, La Paz',
            ]
        ]);


        //Equipo::factory(20)->create();

        DB::table('equipos')->insert([
            [
                'descripcion' => 'carminadora electrica',
                'marca' => 'NordicTrack',
                'fecha_compra' => '2023-05-10',
                'estado' => 1,
                'ultimo_mantenimiento' => null,
                'user_id' => 1,
            ],
            [
                'descripcion' => 'Bicicleta estatica',
                'marca' => 'ProFrom',
                'fecha_compra' => '2022-11-22',
                'estado' => 2,
                'ultimo_mantenimiento' => null,
                'user_id' => 1,
            ],
            [
                'descripcion' => 'Maquina de pesas Multíestación',
                'marca' => 'Body-Solid',
                'fecha_compra' => '2021-08-15',
                'estado' => 0,
                'ultimo_mantenimiento' => null,
                'user_id' => 1,
            ]
        ]);

        //Producto::factory(10)->create();

        DB::table('productos')->insert([
            [
                'descripcion' => 'Proteinas en polvo (1Kg)',
                'precio' => 250.00,
                'stock' => 30,
                'marca' => 'Optimum Nutrition',
                'fecha_vencimiento' => '2026-07-15',
            ],
            [
                'descripcion' => 'Barra Energetica (Unidad)',
                'precio' => 15.00,
                'stock' => 15,
                'marca' => 'PowerBar',
                'fecha_vencimiento' => '2025-11-20',
            ],
            [
                'descripcion' => 'Creatina en Polvo (500 g)',
                'precio' => 180.00,
                'stock' => 25,
                'marca' => 'MuscleTech',
                'fecha_vencimiento' => '2026-05-10',
            ]
        ]);


        //TipoMembresia::factory(5)->create();
        DB::table('tipo_membresias')->insert([
            [
                'nombre' => 'VIP',
                'meses' => 12,
                'precio' => 1400.00,
                'beneficios' => 'Acceso completo, clases grupales, asesoría personalizada y estacionamiento',
            ],
            [
                'nombre' => 'Zumba Plus',
                'meses' => 3,
                'precio' => 500.00,
                'beneficios' => 'Acceso a clases de Zumba ilimitadas y sala de máquinas',
            ],
            [
                'nombre' => 'Basica',
                'meses' => 1,
                'precio' => 150.00,
                'beneficios' => 'Acceso a sala de máquinas y pesas',
            ]
        ]);

        Asistencia::factory(10)->create();

        //Membresia::factory(5)->create();

        DB::table('membresias')->insert([
            [
                'fecha_inicio' => '2025-10-15',
                'fecha_fin' => '2026-10-15',
                'estado' => 'pendiente',
                'precio_pagado' => 700.00,
                'tipomembresia_id' => 1,
                'cliente_id' => 3,
            ]
        ]);
    }
}
