<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;
    protected $table = 'inmueble';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'direccion', 'num_habitaciones', 'superficie', 'categoria', 'precio', 'imagen', 'descripcion', 'wifi', 'piscina', 'ciudad', 'propietario'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'propietario', 'id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'inmueble', 'id');
    }

    public function resenyas()
    {
        return $this->hasMany(Resenya::class, 'inmueble', 'id');
    }
}