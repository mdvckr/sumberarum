<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->foreignId('id_warga')->constrained('warga', 'id_warga')->onDelete('cascade');
            $table->foreignId('id_petugas')->nullable()->constrained('petugas', 'id_petugas')->nullOnDelete();
            $table->string('judul');
            $table->text('isi_pengaduan');
            $table->enum('kategori', ['jalan rusak', 'lampu jalan', 'sampah', 'administrasi', 'saluran air', 'surat menyurat', 'lainnya']);
            $table->string('lokasi');
            $table->string('foto_bukti')->nullable();
            $table->date('tanggal_pengaduan');
            $table->enum('status', ['menunggu', 'diverifikasi', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
