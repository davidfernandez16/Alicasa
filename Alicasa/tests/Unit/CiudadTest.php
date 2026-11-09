<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ciudad;

class CiudadTest extends TestCase
{
    /** @test */
    public function se_puede_crear_una_ciudad()
    {
        $ciudad = Ciudad::factory()->create([
            'codigo_postal' => 3690,
            'provincia' => 'San Vicente',
            'pais' => 'España'
        ]);

        $this->assertEquals('San Vicente', $ciudad->provincia);
    }
}
