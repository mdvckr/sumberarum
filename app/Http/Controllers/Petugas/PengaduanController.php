<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        $petugas = Auth::guard('petugas')->user();
        $pengaduans = Pengaduan::with('warga')->where('id_petugas', $petugas->id_petugas)->latest()->get();
        return view('petugas.pengaduan.index', compact('pengaduans'));
    }

    public function detail($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'tanggapans.petugas'])->findOrFail($id);
        return view('petugas.pengaduan.detail', compact('pengaduan'));
    }

    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
            'status' => 'required|in:diproses,selesai',
        ]);

        $petugas = Auth::guard('petugas')->user();

        Tanggapan::create([
            'id_pengaduan' => $id,
            'id_petugas' => $petugas->id_petugas,
            'isi_tanggapan' => $request->isi_tanggapan,
            'tanggal_tanggapan' => now()->toDateString(),
        ]);

        Pengaduan::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->route('petugas.pengaduan.index')->with('success', 'Tanggapan berhasil dikirim.');
    }
}
