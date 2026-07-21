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
            'status'       => 'required|in:diverifikasi,ditolak,selesai',
            'id_petugas'   => 'nullable|exists:petugas,id_petugas',
            'catatan_admin'=> 'nullable|string|max:1000',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status'        => $request->status,
            'id_petugas'    => $request->id_petugas,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.pengaduan.detail', $id)
                         ->with('success', 'Validasi berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();
        return response()->json(['success' => true, 'message' => 'Pengaduan berhasil dihapus.']);
    }
}
