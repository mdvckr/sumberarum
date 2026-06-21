<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nama_admin' => 'Admin Kalurahan Sumberarum',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}
