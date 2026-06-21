<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function dashboard()
    {
        $warga = Auth::guard('warga')->user();
        $pengaduans = Pengaduan::where('id_warga', $warga->id_warga)->latest()->get();
        return view('warga.dashboard', compact('warga', 'pengaduans'));
    }

    public function buatPengaduan()
    {
        return view('warga.pengaduan.create');
    }

    public function simpanPengaduan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi_pengaduan' => 'required|string',
            'kategori' => 'required|string',
            'lokasi' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti')->store('foto_pengaduan', 'public');
        }

        $warga = Auth::guard('warga')->user();

        Pengaduan::create([
            'id_warga' => $warga->id_warga,
            'judul' => $request->judul,
            'isi_pengaduan' => $request->isi_pengaduan,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'foto_bukti' => $foto,
            'tanggal_pengaduan' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function detailPengaduan($id)
    {
        $warga = Auth::guard('warga')->user();
        $pengaduan = Pengaduan::with('tanggapans.petugas')
            ->where('id_warga', $warga->id_warga)
            ->findOrFail($id);
        return view('warga.pengaduan.detail', compact('pengaduan'));
    }
}
