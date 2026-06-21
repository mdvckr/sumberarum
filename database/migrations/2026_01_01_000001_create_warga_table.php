<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id('id_warga');
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);
            $table->string('nama');
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp', 15);
            $table->enum('status_verifikasi', ['menunggu', 'terverifikasi', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
