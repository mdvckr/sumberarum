<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $fillable = ['nama_petugas', 'username', 'password', 'jabatan', 'no_hp'];
    protected $hidden = ['password'];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'id_petugas', 'id_petugas');
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }
}
