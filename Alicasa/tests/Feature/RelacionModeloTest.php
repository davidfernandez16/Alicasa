<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ciudad;
use App\Models\Inmueble;
use App\Models\Resenya;

class RelacionModeloTest extends TestCase
{
    /** @test */
    public function una_ciudad_puede_tener_multiples_inmuebles()
    {
        $ciudad = Ciudad::factory()->create();
        $inmueble1 = Inmueble::factory()->create(['ciudad_id' => $ciudad->codigo_postal]);
        $inmueble2 = Inmueble::factory()->create(['ciudad_id' => $ciudad->codigo_postal]);

        $this->assertEquals(2, $ciudad->inmuebles()->count());
    }

    /** @test */
    public function un_inmueble_puede_tener_multiples_resenyas()
    {
        $inmueble = Inmueble::factory()->create();
        Resenya::factory()->create(['inmueble_id' => $inmueble->cod]);
        Resenya::factory()->create(['inmueble_id' => $inmueble->cod]);

        $this->assertEquals(2, $inmueble->resenyas()->count());
    }
}