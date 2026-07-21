<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\VerifikasiWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiWargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::where('status_verifikasi', 'menunggu')->get();
        return view('admin.verifikasi.index', compact('wargas'));
    }
    
    public function proses(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terverifikasi,ditolak',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update(['status_verifikasi' => $request->status]);

        VerifikasiWarga::create([
            'id_warga' => $warga->id_warga,
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'status' => $request->status,
            'tanggal_verifikasi' => now()->toDateString(),
        ]);

        return redirect()->route('admin.verifikasi.index')->with('success', 'Verifikasi warga berhasil diproses.');
    }

    // Method khusus untuk menangani AJAX
    public function prosesAjax(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terverifikasi,ditolak',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update(['status_verifikasi' => $request->status]);

        VerifikasiWarga::create([
            'id_warga' => $warga->id_warga,
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'status' => $request->status,
            'tanggal_verifikasi' => now()->toDateString(),
        ]);

        // Mengembalikan respons JSON agar halaman tidak perlu reload
        return response()->json([
            'success' => true,
            'message' => 'Verifikasi warga berhasil diproses.',
            'id_warga' => $id
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->q;
        $wargas = Warga::where('status_verifikasi', 'menunggu')
            ->where(function($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%");
            })->get();
            
        return view('admin.verifikasi.partial_table', compact('wargas'));
    }
}