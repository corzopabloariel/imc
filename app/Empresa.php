<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'contactos',//JSON
        'images',//JSON
        'domicilio',
        'metadatos'
    ];
}
