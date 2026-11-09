<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Inmueble;

class InmuebleTest extends TestCase
{
    /** @test */
    public function se_puede_crear_un_inmueble()
    {
        $inmueble = Inmueble::factory()->create([
            'direccion' => 'Calle Falsa 123',
            'num_habitaciones' => 3,
            'superficie' => 120,
            'categoria' => 'Casa',
            'precio' => 150000.00,
            'descripcion' => 'Hermosa casa',
            'wifi' => true,
            'piscina' => false,
            'ciudad_id' => 28001
        ]);

        $this->assertEquals('Casa', $inmueble->categoria);
    }
}