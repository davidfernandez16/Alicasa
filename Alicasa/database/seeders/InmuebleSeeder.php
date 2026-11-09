<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InmuebleSeeder extends Seeder
{
    public function run()
    {
        DB::table('inmueble')->insert([
            ['direccion' => 'Calle Mayor 11','num_habitaciones' => 3,'superficie' => 120,'categoria' => 'Apartamento','precio' => 35,'imagen' => 'img/inmuebles/inmueble_1.png','descripcion' => 'Bonito apartamento céntrico.','wifi' => true,'piscina' => false,'ciudad' => 1,'propietario' => 3,],
            ['direccion' => 'Avenida Principal 5','num_habitaciones' => 4,'superficie' => 200,'categoria' => 'Casa','precio' => 50,'imagen' => 'img/inmuebles/inmueble_2.png','descripcion' => 'Casa con jardín y piscina.','wifi' => true,'piscina' => true,'ciudad' => 2,'propietario' => 4,],
            ['direccion' => 'Calle Castellana 23','num_habitaciones' => 2,'superficie' => 90,'categoria' => 'Piso','precio' => 25,'imagen' => 'img/inmuebles/inmueble_3.png','descripcion' => 'Piso para dos perfecto para vacaciones.','wifi' => true,'piscina' => false,'ciudad' => 3,'propietario' => 4,],
            ['direccion' => 'Avenida de la Constitución 5', 'num_habitaciones' => 2, 'superficie' => 90, 'categoria' => 'Piso', 'precio' => 45,'imagen' => 'img/inmuebles/inmueble_4.png', 'descripcion' => 'Piso luminoso con terraza.', 'wifi' => true, 'piscina' => true, 'ciudad' => 2, 'propietario' => 16],
            ['direccion' => 'Calle del Mar 23', 'num_habitaciones' => 1, 'superficie' => 60, 'categoria' => 'Estudio', 'precio' => 25,'imagen' => 'img/inmuebles/inmueble_5.png',  'descripcion' => 'Pequeño estudio cerca de la playa.', 'wifi' => false, 'piscina' => false, 'ciudad' => 3, 'propietario' => 2],
            ['direccion' => 'Calle Sol 45', 'num_habitaciones' => 4, 'superficie' => 150, 'categoria' => 'Chalet', 'precio' => 70,'imagen' => 'img/inmuebles/inmueble_6.png',  'descripcion' => 'Amplio chalet con jardín.', 'wifi' => true, 'piscina' => true, 'ciudad' => 4, 'propietario' => 4],
            ['direccion' => 'Avenida Norte 67', 'num_habitaciones' => 2, 'superficie' => 80, 'categoria' => 'Dúplex', 'precio' => 55,'imagen' => 'img/inmuebles/inmueble_7.png',  'descripcion' => 'Dúplex moderno con vistas.', 'wifi' => true, 'piscina' => false, 'ciudad' => 5, 'propietario' => 5],
            ['direccion' => 'Plaza España 10', 'num_habitaciones' => 3, 'superficie' => 110, 'categoria' => 'Piso', 'precio' => 50,'imagen' => 'img/inmuebles/inmueble_8.png',  'descripcion' => 'Piso céntrico con balcones.', 'wifi' => true, 'piscina' => false, 'ciudad' => 6, 'propietario' => 2],
            ['direccion' => 'Calle Luna 12', 'num_habitaciones' => 2, 'superficie' => 95, 'categoria' => 'Apartamento', 'precio' => 40,'imagen' => 'img/inmuebles/inmueble_9.png',  'descripcion' => 'Apartamento con vistas al mar.', 'wifi' => true, 'piscina' => true, 'ciudad' => 7, 'propietario' => 16],
            ['direccion' => 'Avenida del Parque 8', 'num_habitaciones' => 1, 'superficie' => 50, 'categoria' => 'Estudio', 'precio' => 30,'imagen' => 'img/inmuebles/inmueble_10.png',  'descripcion' => 'Estudio acogedor cerca del parque.', 'wifi' => true, 'piscina' => false, 'ciudad' => 8, 'propietario' => 3],
            ['direccion' => 'Paseo Marítimo 21', 'num_habitaciones' => 4, 'superficie' => 200, 'categoria' => 'Villa', 'precio' => 100,'imagen' => 'img/inmueble.png',  'descripcion' => 'Villa de lujo en primera línea de playa.', 'wifi' => true, 'piscina' => true, 'ciudad' => 9, 'propietario' => 4],
            ['direccion' => 'Calle de la Sierra 3', 'num_habitaciones' => 5, 'superficie' => 180, 'categoria' => 'Casa_rural', 'precio' => 80,'imagen' => 'img/inmueble.png', 'descripcion' => 'Casa rural en plena naturaleza.', 'wifi' => false, 'piscina' => true, 'ciudad' => 10, 'propietario' => 5],
            ['direccion' => 'Calle Nueva 15', 'num_habitaciones' => 3, 'superficie' => 130, 'categoria' => 'Chalet', 'precio' => 60,'imagen' => 'img/inmueble.png', 'descripcion' => 'Chalet con amplio garaje.', 'wifi' => true, 'piscina' => true, 'ciudad' => 11, 'propietario' => 20],
            ['direccion' => 'Calle Verde 6', 'num_habitaciones' => 1, 'superficie' => 55, 'categoria' => 'Loft', 'precio' => 28,'imagen' => 'img/inmueble.png', 'descripcion' => 'Loft moderno en el centro.', 'wifi' => true, 'piscina' => false, 'ciudad' => 12, 'propietario' => 2],
            ['direccion' => 'Avenida Central 9', 'num_habitaciones' => 2, 'superficie' => 85, 'categoria' => 'Piso', 'precio' => 42,'imagen' => 'img/inmueble.png', 'descripcion' => 'Piso con aire acondicionado.', 'wifi' => true, 'piscina' => false, 'ciudad' => 13, 'propietario' => 3],
            ['direccion' => 'Calle Peatonal 7', 'num_habitaciones' => 3, 'superficie' => 115, 'categoria' => 'Dúplex', 'precio' => 48,'imagen' => 'img/inmueble.png', 'descripcion' => 'Dúplex con terraza privada.', 'wifi' => true, 'piscina' => true, 'ciudad' => 14, 'propietario' => 4],
            ['direccion' => 'Paseo del Río 14', 'num_habitaciones' => 3, 'superficie' => 140, 'categoria' => 'Adosado', 'precio' => 58,'imagen' => 'img/inmueble.png', 'descripcion' => 'Adosado con patio y barbacoa.', 'wifi' => true, 'piscina' => false, 'ciudad' => 15, 'propietario' => 2],
            ['direccion' => 'Calle Tranquila 2', 'num_habitaciones' => 2, 'superficie' => 75, 'categoria' => 'Apartamento', 'precio' => 38,'imagen' => 'img/inmueble.png', 'descripcion' => 'Apartamento en zona residencial.', 'wifi' => true, 'piscina' => true, 'ciudad' => 16, 'propietario' => 3],
            ['direccion' => 'Avenida Montaña 10', 'num_habitaciones' => 4, 'superficie' => 160, 'categoria' => 'Chalet', 'precio' => 65,'imagen' => 'img/inmueble.png', 'descripcion' => 'Chalet con vistas a la montaña.', 'wifi' => true, 'piscina' => true, 'ciudad' => 17, 'propietario' => 20],
            ['direccion' => 'Calle Pequeña 5', 'num_habitaciones' => 1, 'superficie' => 40, 'categoria' => 'Estudio', 'precio' => 22,'imagen' => 'img/inmueble.png', 'descripcion' => 'Estudio económico en buena ubicación.', 'wifi' => false, 'piscina' => false, 'ciudad' => 18, 'propietario' => 5]
        ]);
    }
}
