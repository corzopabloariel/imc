<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpassword extends Model
{
    protected $table = "user_password";
    
    protected $fillable = [
        'user_id',
        'estado'
    ];
}