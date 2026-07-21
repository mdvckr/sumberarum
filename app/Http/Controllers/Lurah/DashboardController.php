<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();

        // Mengambil semua pengaduan (monitoring)
        $pengaduans = Pengaduan::with(['warga', 'petugas'])->latest()->get();

        return view('lurah.dashboard', compact(
            'totalPengaduan', 'menunggu', 'diproses', 'selesai', 'ditolak', 'pengaduans'
        ));
    }
}
