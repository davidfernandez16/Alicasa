<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resenya;
use App\Models\Inmueble;

class ResenyaFactory extends Factory
{
    protected $model = Resenya::class;

    public function definition()
    {
        return [
            'usuario' => $this->faker->userName,
            'valoracion_inmueble' => $this->faker->numberBetween(1, 5),
            'valoracion_propietario' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->sentence,
            'inmueble_id' => Inmueble::factory(), // Relación con Inmueble
        ];
    }
}