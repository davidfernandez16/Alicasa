<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Creando la tabla ciudad!' );
        $this->call( CiudadSeeder::class );
        $this->command->info('Creando la tabla usuario!' );
        $this->call( UsuarioSeeder::class );
        $this->command->info('Creando la tabla inmueble!' );
        $this->call( InmuebleSeeder::class );
        $this->command->info('Creando la tabla reserva!' );
        $this->call( ReservaSeeder::class );
        $this->command->info('Creando la tabla reseña!' );
        $this->call( ResenyaSeeder::class );
        
    }
}
