<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResenyaSeeder extends Seeder
{
    public function run()
    {
        DB::table('resenya')->insert([
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 5,
                'comentario' => 'El apartamento estaba muy bien ubicado y limpio.',
                'usuario' => 1,
                'inmueble' => 1,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 4,
                'comentario' => 'La casa era espectacular, aunque el dueño tardó en responder.',
                'usuario' => 2,
                'inmueble' => 2,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 4,
                'comentario' => 'La casa con jardín y piscina es perfecta para unas vacaciones familiares.',
                'usuario' => 3,
                'inmueble' => 2,
            ],
            [
                'valoracion_inmueble' => 3,
                'valoracion_propietario' => 5,
                'comentario' => 'El piso es pequeño, pero perfecto para una estancia corta.',
                'usuario' => 10,
                'inmueble' => 3,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 4,
                'comentario' => 'El piso tiene una buena ubicación, pero podría estar mejor mantenido.',
                'usuario' => 7,
                'inmueble' => 4,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 5,
                'comentario' => 'Excelente apartamento, todo muy limpio y bien cuidado.',
                'usuario' => 9,
                'inmueble' => 5,
            ],
            [
                'valoracion_inmueble' => 3,
                'valoracion_propietario' => 4,
                'comentario' => 'El estudio es acogedor, pero el acceso a la playa no es tan cercano como se esperaba.',
                'usuario' => 12,
                'inmueble' => 6,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 3,
                'comentario' => 'La casa es bastante amplia, pero el dueño no respondió muy rápido a mis preguntas.',
                'usuario' => 5,
                'inmueble' => 7,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 5,
                'comentario' => 'El dúplex tiene unas vistas increíbles, me encantó.',
                'usuario' => 8,
                'inmueble' => 8,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 4,
                'comentario' => 'Buen apartamento, aunque la conexión Wi-Fi no era tan buena.',
                'usuario' => 14,
                'inmueble' => 9,
            ],
            [
                'valoracion_inmueble' => 3,
                'valoracion_propietario' => 3,
                'comentario' => 'El estudio es pequeño y básico, pero funcional para unos días.',
                'usuario' => 6,
                'inmueble' => 10,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 4,
                'comentario' => 'La villa es impresionante, aunque el precio es algo elevado.',
                'usuario' => 13,
                'inmueble' => 11,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 5,
                'comentario' => 'Casa rural muy bonita, perfecta para desconectar en la naturaleza.',
                'usuario' => 2,
                'inmueble' => 12,
            ],
            [
                'valoracion_inmueble' => 3,
                'valoracion_propietario' => 4,
                'comentario' => 'El chalet está bien, pero faltan algunos detalles en la limpieza.',
                'usuario' => 11,
                'inmueble' => 13,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 5,
                'comentario' => 'La ubicación del loft es excelente, y todo estaba impecable.',
                'usuario' => 15,
                'inmueble' => 14,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 4,
                'comentario' => 'Piso con aire acondicionado, todo en orden aunque la decoración es un poco antigua.',
                'usuario' => 14,
                'inmueble' => 15,
            ],
            [
                'valoracion_inmueble' => 3,
                'valoracion_propietario' => 4,
                'comentario' => 'El dúplex es agradable, pero la piscina no estaba disponible durante mi estancia.',
                'usuario' => 10,
                'inmueble' => 16,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 5,
                'comentario' => 'Muy buen adosado, pero el patio podría ser más grande.',
                'usuario' => 12,
                'inmueble' => 17,
            ],
            [
                'valoracion_inmueble' => 5,
                'valoracion_propietario' => 5,
                'comentario' => 'Apartamento excelente, muy cómodo y bien situado.',
                'usuario' => 3,
                'inmueble' => 18,
            ],
            [
                'valoracion_inmueble' => 4,
                'valoracion_propietario' => 4,
                'comentario' => 'El chalet está bien, aunque me gustaría que tuviera más servicios adicionales.',
                'usuario' => 7,
                'inmueble' => 19,
            ],
        ]);
    }
}
