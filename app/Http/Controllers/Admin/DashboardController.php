<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();
        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        $terbaru = Pengaduan::with('warga')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalWarga', 'totalPengaduan', 'menunggu', 'diproses', 'selesai', 'ditolak', 'terbaru'
        ));
    }
}
