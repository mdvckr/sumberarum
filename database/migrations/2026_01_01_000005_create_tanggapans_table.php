<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id('id_tanggapan');
            $table->foreignId('id_pengaduan')->constrained('pengaduans', 'id_pengaduan')->onDelete('cascade');
            $table->foreignId('id_petugas')->constrained('petugas', 'id_petugas')->onDelete('cascade');
            $table->text('isi_tanggapan');
            $table->date('tanggal_tanggapan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapans');
    }
};
