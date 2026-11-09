<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $table = 'reserva';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'dias', 'precio_total', 'usuario', 'inmueble','estado'];
    protected $dates = ['fecha_inicio', 'fecha_fin'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'inmueble', 'id');
    }
}