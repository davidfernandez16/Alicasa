<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudad';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','codigo_postal', 'localidad', 'provincia', 'pais'];

    public function inmuebles()
    {
        return $this->hasMany(Inmueble::class, 'ciudad', 'id');
    }
}