<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $fillable = [
        
        'email',
        'password',
        'nombre',
        'apellidos',
        'telefono',
        'imagen',
        'propietario',
        'administrador',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function inmuebles()
    {
        return $this->hasMany(Inmueble::class, 'propietario', 'id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'usuario', 'id');
    }

    public function resenyas()
    {
        return $this->hasMany(Resenya::class, 'usuario', 'id');
    }
}

