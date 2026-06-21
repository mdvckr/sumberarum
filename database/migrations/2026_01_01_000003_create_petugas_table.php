<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama_petugas');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('jabatan');
            $table->string('no_hp', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas');
    }
};
