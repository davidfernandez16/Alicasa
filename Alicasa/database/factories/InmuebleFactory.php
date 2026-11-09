<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inmueble;
use App\Models\Ciudad;

class InmuebleFactory extends Factory
{
    protected $model = Inmueble::class;

    public function definition()
    {
        return [
            'direccion' => $this->faker->address,
            'num_habitaciones' => $this->faker->numberBetween(1, 5),
            'superficie' => $this->faker->numberBetween(50, 500),
            'categoria' => $this->faker->randomElement(['Casa', 'Chalet', 'Departamento']),
            'precio' => $this->faker->randomFloat(2, 50000, 500000),
            'imagen' => $this->faker->imageUrl(640, 480, 'house', true),
            'descripcion' => $this->faker->sentence,
            'wifi' => $this->faker->boolean,
            'piscina' => $this->faker->boolean,
            'ciudad_id' => Ciudad::factory(), // Relación con Ciudad
        ];
    }
}