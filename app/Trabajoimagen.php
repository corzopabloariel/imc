<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajoimagen extends Model
{
    protected $fillable = [
        'image',
        'orden',
        'trabajo_id'
    ];
}
