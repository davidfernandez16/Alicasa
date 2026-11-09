<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    public function run()
    {
        DB::table('reserva')->insert([
            [
                'fecha_inicio' => '2025-04-01',
                'fecha_fin' => '2025-04-10',
                'precio_total' => 315, // 9 noches x 35€
                'usuario' => 2,
                'inmueble' => 1,
            ],
            [
                'fecha_inicio' => '2025-05-05',
                'fecha_fin' => '2025-05-08',
                'precio_total' => 105, // 3 noches x 35€
                'usuario' => 4,
                'inmueble' => 1,
            ],
            [
                'fecha_inicio' => '2025-06-15',
                'fecha_fin' => '2025-06-20',
                'precio_total' => 175, // 5 noches x 35€
                'usuario' => 15,
                'inmueble' => 1,
            ],
            [
                'fecha_inicio' => '2025-04-10',
                'fecha_fin' => '2025-04-15',
                'precio_total' => 250, // 5 x 50€
                'usuario' => 5,
                'inmueble' => 2,
            ],
            [
                'fecha_inicio' => '2025-07-01',
                'fecha_fin' => '2025-07-07',
                'precio_total' => 300, // 6 x 50€
                'usuario' => 2,
                'inmueble' => 2,
            ],
            [
                'fecha_inicio' => '2025-03-20',
                'fecha_fin' => '2025-03-25',
                'precio_total' => 125, // 5 x 25€
                'usuario' => 3,
                'inmueble' => 3,
            ],
            [
                'fecha_inicio' => '2025-05-12',
                'fecha_fin' => '2025-05-14',
                'precio_total' => 50, // 2 x 25€
                'usuario' => 5,
                'inmueble' => 3,
            ],
            [
                'fecha_inicio' => '2025-06-05',
                'fecha_fin' => '2025-06-10',
                'precio_total' => 125, // 5 x 25€
                'usuario' => 7,
                'inmueble' => 3,
            ],
            [
                'fecha_inicio' => '2025-04-01',
                'fecha_fin' => '2025-04-06',
                'precio_total' => 225, // 5 x 45€
                'usuario' => 6,
                'inmueble' => 4,
            ],
            [
                'fecha_inicio' => '2025-04-08',
                'fecha_fin' => '2025-04-12',
                'precio_total' => 180, // 4 x 45€
                'usuario' => 2,
                'inmueble' => 4,
            ],
            [
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-06-04',
                'precio_total' => 135, // 3 x 45€
                'usuario' => 3,
                'inmueble' => 4,
            ],
            [
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-05-03',
                'precio_total' => 50, // 2 x 25€
                'usuario' => 5,
                'inmueble' => 5,
            ],
            [
                'fecha_inicio' => '2025-07-10',
                'fecha_fin' => '2025-07-15',
                'precio_total' => 125, // 5 x 25€
                'usuario' => 4,
                'inmueble' => 5,
            ],
            [
                'fecha_inicio' => '2025-08-01',
                'fecha_fin' => '2025-08-06',
                'precio_total' => 125, // 5 x 25€
                'usuario' => 6,
                'inmueble' => 5,
            ],
            [
                'fecha_inicio' => '2025-06-10',
                'fecha_fin' => '2025-06-13',
                'precio_total' => 90, // 3 x 30€
                'usuario' => 2,
                'inmueble' => 10,
            ],
            [
                'fecha_inicio' => '2025-08-02',
                'fecha_fin' => '2025-08-07',
                'precio_total' => 150, // 5 x 30€
                'usuario' => 9,
                'inmueble' => 10,
            ],
            [
                'fecha_inicio' => '2025-04-07',
                'fecha_fin' => '2025-04-10',
                'precio_total' => 165, // 3 x 55€
                'usuario' => 12,
                'inmueble' => 7,
            ],
            [
                'fecha_inicio' => '2025-09-22',
                'fecha_fin' => '2025-09-24',
                'precio_total' => 110, // 2 x 55€
                'usuario' => 14,
                'inmueble' => 7,
            ],
            [
                'fecha_inicio' => '2025-12-26',
                'fecha_fin' => '2025-12-20',
                'precio_total' => 330, // 6 x 55€
                'usuario' => 17,
                'inmueble' => 7,
            ],
            [
                'fecha_inicio' => '2025-03-19',
                'fecha_fin' => '2025-03-20',
                'precio_total' => 40, // 1 x 40€
                'usuario' => 13,
                'inmueble' => 9,
            ],
            [
                'fecha_inicio' => '2025-10-06',
                'fecha_fin' => '2025-10-08',
                'precio_total' => 80, // 2 x 40€
                'usuario' => 10,
                'inmueble' => 9,
            ],
            [
                'fecha_inicio' => '2025-05-13',
                'fecha_fin' => '2025-05-17',
                'precio_total' => 160, // 4 x 40€
                'usuario' => 18,
                'inmueble' => 9,
            ],
        ]);
    }
}
