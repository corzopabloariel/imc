<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'tipo',
        'orden',
        'data',
        'producto_id'
    ];
}
