<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = [
        'nombre',
        'empresa',
        'ubicacion',
        'volumen',
        'familia_id',
        'orden',
        'data'
    ];
    public function imagenes()
    {
        return $this->hasMany('App\Trabajoimagen')->orderBy('orden');
        
    }
}
