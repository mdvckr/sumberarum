<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        Petugas::create([
            'nama_petugas' => 'Budi Santoso',
            'username' => 'budi',
            'password' => Hash::make('petugas123'),
            'jabatan' => 'Petugas Lapangan',
            'no_hp' => '081234567890',
        ]);

        Petugas::create([
            'nama_petugas' => 'Siti Rahayu',
            'username' => 'siti',
            'password' => Hash::make('petugas123'),
            'jabatan' => 'Petugas Administrasi',
            'no_hp' => '081234567891',
        ]);
    }
}
