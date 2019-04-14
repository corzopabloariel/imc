<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'img',
        'seccion',
        'texto',
        'image',
        'orden'
    ];
}
