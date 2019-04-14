<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'img',
        'titulo',
        'texto',
        'orden',
        'producto_id'
    ];
}
