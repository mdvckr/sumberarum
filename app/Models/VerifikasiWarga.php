<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiWarga extends Model
{
    protected $table = 'verifikasi_wargas';
    protected $primaryKey = 'id_verifikasi_warga';

    protected $fillable = ['id_warga', 'id_admin', 'status', 'tanggal_verifikasi'];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga', 'id_warga');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
