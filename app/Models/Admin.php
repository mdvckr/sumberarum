<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['nama_admin', 'username', 'password'];
    protected $hidden = ['password'];

    public function verifikasiWarga()
    {
        return $this->hasMany(VerifikasiWarga::class, 'id_admin', 'id_admin');
    }
}
