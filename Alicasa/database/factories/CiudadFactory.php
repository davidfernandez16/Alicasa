<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ciudad;

class CiudadFactory extends Factory
{
    protected $model = Ciudad::class;

    public function definition()
    {
        return [
            'codigo_postal' => $this->faker->randomNumber(5, true), // Código postal realista
            'provincia' => $this->faker->state,
            'pais' => $this->faker->country,
        ];
    }
}