<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadSeeder extends Seeder
{
    public function run()
    {
        DB::table('ciudad')->insert([
            ['codigo_postal' => 07025, 'localidad' => 'Barcelona', 'provincia' => 'Barcelona', 'pais' => 'España'],
            ['codigo_postal' => 28933, 'localidad' => 'Mostoles', 'provincia' => 'Madrid', 'pais' => 'España'],
            ['codigo_postal' => 03065, 'localidad' => 'Elche', 'provincia' => 'Alicante', 'pais' => 'España'],
            ['codigo_postal' => 12540, 'localidad' => 'Villarreal', 'provincia' => 'Castellón', 'pais' => 'España'],
            ['codigo_postal' => 28001, 'localidad' => 'Madrid', 'provincia' => 'Madrid', 'pais' => 'España'],
            ['codigo_postal' => 41001, 'localidad' => 'Sevilla', 'provincia' => 'Sevilla', 'pais' => 'España'],
            ['codigo_postal' => 46001, 'localidad' => 'Valencia', 'provincia' => 'Valencia', 'pais' => 'España'],
            ['codigo_postal' => 50001, 'localidad' => 'Zaragoza', 'provincia' => 'Zaragoza', 'pais' => 'España'],
            ['codigo_postal' => 15001, 'localidad' => 'A Coruña', 'provincia' => 'A Coruña', 'pais' => 'España'],
            ['codigo_postal' => 29001, 'localidad' => 'Málaga', 'provincia' => 'Málaga', 'pais' => 'España'],
            ['codigo_postal' => 35001, 'localidad' => 'Las Palmas', 'provincia' => 'Las Palmas', 'pais' => 'España'],
            ['codigo_postal' => 38001, 'localidad' => 'Santa Cruz de Tenerife', 'provincia' => 'Santa Cruz de Tenerife', 'pais' => 'España'],
            ['codigo_postal' => 20001, 'localidad' => 'San Sebastián', 'provincia' => 'Guipúzcoa', 'pais' => 'España'],
            ['codigo_postal' => 03001, 'localidad' => 'Alicante', 'provincia' => 'Alicante', 'pais' => 'España'],
            ['codigo_postal' => 33001, 'localidad' => 'Oviedo', 'provincia' => 'Asturias', 'pais' => 'España'],
            ['codigo_postal' => 11001, 'localidad' => 'Cádiz', 'provincia' => 'Cádiz', 'pais' => 'España'],
            ['codigo_postal' => 17001, 'localidad' => 'Girona', 'provincia' => 'Girona', 'pais' => 'España'],
            ['codigo_postal' => 22001, 'localidad' => 'Huesca', 'provincia' => 'Huesca', 'pais' => 'España'],
            ['codigo_postal' => 24001, 'localidad' => 'León', 'provincia' => 'León', 'pais' => 'España'],
            ['codigo_postal' => 26001, 'localidad' => 'Logroño', 'provincia' => 'La Rioja', 'pais' => 'España'],
        ]);
    }
}
