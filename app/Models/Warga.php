<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Warga extends Authenticatable
{
    protected $table = 'warga';
    protected $primaryKey = 'id_warga';

    protected $fillable = [
        'nik', 'no_kk', 'nama', 'alamat', 'rt', 'rw',
        'email', 'password', 'no_hp', 'status_verifikasi',
    ];

    protected $hidden = ['password'];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'id_warga', 'id_warga');
    }

    public function verifikasi()
    {
        return $this->hasMany(VerifikasiWarga::class, 'id_warga', 'id_warga');
    }
}
