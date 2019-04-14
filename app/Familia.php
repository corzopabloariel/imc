<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $fillable = [
        'titulo',
        'img',
        'orden'
    ];
    public function productos()
    {
        return $this->hasMany('App\Producto')->orderBy('orden');
    }
}
