<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuariocliente extends Model
{
    protected $fillable = [
        'name',
        'password',
        'username',
        'fecha',//USADO EN CLIENTE --> CRONJOB?
        'estado',
        'tipo'
    ];
}