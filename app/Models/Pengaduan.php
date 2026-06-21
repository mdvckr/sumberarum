<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduans';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_warga', 'id_petugas', 'judul', 'isi_pengaduan',
        'kategori', 'lokasi', 'foto_bukti', 'tanggal_pengaduan', 'status',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga', 'id_warga');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }
}
