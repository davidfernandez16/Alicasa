<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenya extends Model
{
    use HasFactory;
    protected $table = 'resenya';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'valoracion_inmueble', 'valoracion_propietario', 'comentario', 'usuario', 'inmueble'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'inmueble', 'id');
    }
}