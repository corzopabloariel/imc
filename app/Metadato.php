<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadato extends Model
{
    protected $fillable = [
        'seccion',
        'meta',
        'descripcion'
    ];
}
