<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    /**
     * Menampilkan daftar pengaduan milik petugas yang sedang login.
     */
    public function index()
    {
        $petugas = Auth::guard('petugas')->user();
        
        $pengaduans = Pengaduan::with('warga')
            ->where('id_petugas', $petugas->id_petugas)
            ->latest()
            ->get();
            
        return view('petugas.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Menampilkan detail pengaduan dengan pengaman akses.
     */
    public function detail($id)
    {
        $petugas = Auth::guard('petugas')->user();

        // Pastikan pengaduan ada DAN memang milik petugas yang sedang login
        $pengaduan = Pengaduan::with(['warga', 'tanggapans.petugas'])
            ->where('id_pengaduan', $id) // Sesuaikan primary key jika tabel menggunakan 'id'
            ->where('id_petugas', $petugas->id_petugas)
            ->firstOrFail();

        return view('petugas.pengaduan.detail', compact('pengaduan'));
    }

    /**
     * Menyimpan tanggapan dan memperbarui status pengaduan dengan transaksi aman.
     */
    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
            'status' => 'required|in:diproses,selesai',
        ]);

        $petugas = Auth::guard('petugas')->user();

        // Validasi pengaduan harus milik petugas ini sebelum ditanggapi
        $pengaduan = Pengaduan::where('id_pengaduan', $id)
            ->where('id_petugas', $petugas->id_petugas)
            ->firstOrFail();

        try {
            // Gunakan Database Transaction agar aman dari error parsial
            DB::transaction(function () use ($request, $id, $petugas, $pengaduan) {
                Tanggapan::create([
                    'id_pengaduan' => $id,
                    'id_petugas' => $petugas->id_petugas,
                    'isi_tanggapan' => $request->isi_tanggapan,
                    'tanggal_tanggapan' => now()->toDateString(),
                ]);

                $pengaduan->update([
                    'status' => $request->status
                ]);
            });

            return redirect()->route('petugas.pengaduan.index')
                ->with('success', 'Tanggapan berhasil dikirim.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan tanggapan: ' . $e->getMessage())
                ->withInput();
        }
    }
}