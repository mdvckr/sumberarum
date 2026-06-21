<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with('warga')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function detail($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'petugas', 'tanggapans.petugas'])->findOrFail($id);
        $petugas = Petugas::all();
        return view('admin.pengaduan.detail', compact('pengaduan', 'petugas'));
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diverifikasi,ditolak',
            'id_petugas' => 'nullable|exists:petugas,id_petugas',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status,
            'id_petugas' => $request->id_petugas,
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status pengaduan berhasil diupdate.');
    }
}
