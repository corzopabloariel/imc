<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = [
        'nombre',
        'subtitulo',
        'descripcion',
        'image',
        'empresa',
        'ubicacion',
        'volumen',
        'tiempo',
        'order',
        'familia_id'
    ];
    public function imagenes()
    {
        return $this->hasMany('App\Trabajoimagen')->orderBy('orden');
        
    }
}
