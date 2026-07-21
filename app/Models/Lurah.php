<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Lurah extends Authenticatable
{
    protected $table = 'lurahs';
    protected $primaryKey = 'id_lurah';
    
    protected $fillable = [
        'nama_lurah',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
