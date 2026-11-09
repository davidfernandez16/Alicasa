<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Resenya;

class ResenyaTest extends TestCase
{
    /** @test */
    public function se_puede_crear_una_resenya()
    {
        $resenya = Resenya::factory()->create([
            'usuario' => 'JuanPerez',
            'valoracion_inmueble' => 5,
            'valoracion_propietario' => 4,
            'comentario' => 'Muy buena experiencia',
            'inmueble_id' => 1
        ]);

        $this->assertEquals('JuanPerez', $resenya->usuario);
    }
}