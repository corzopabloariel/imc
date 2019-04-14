<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productosimg extends Model
{
    protected $table = "productosimg";
    
    protected $fillable = [
        'img',
        'producto_id',
        'orden'
    ];
}
