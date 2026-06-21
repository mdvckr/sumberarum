<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $petugas = Auth::guard('petugas')->user();
        $pengaduans = Pengaduan::with('warga')->where('id_petugas', $petugas->id_petugas)->latest()->get();
        $diproses = $pengaduans->where('status', 'diproses')->count();
        $selesai = $pengaduans->where('status', 'selesai')->count();

        return view('petugas.dashboard', compact('petugas', 'pengaduans', 'diproses', 'selesai'));
    }
}
