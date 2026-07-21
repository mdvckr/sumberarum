<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->get();
        $petugas = Petugas::latest()->get();
        return view('admin.users.index', compact('wargas', 'petugas'));
    }

    // CRUD Warga
    public function storeWarga(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:warga,nik|max:16',
            'no_kk' => 'required|max:16',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:warga,email',
            'password' => 'required|min:6',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'no_hp' => 'required|string|max:15',
            'status_verifikasi' => 'required|in:menunggu,terverifikasi,ditolak'
        ]);

        Warga::create([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'no_hp' => $request->no_hp,
            'status_verifikasi' => $request->status_verifikasi,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Warga berhasil ditambahkan!');
    }

    public function updateWarga(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);
        $request->validate([
            'nik' => 'required|max:16|unique:warga,nik,'.$id.',id_warga',
            'no_kk' => 'required|max:16',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:warga,email,'.$id.',id_warga',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'no_hp' => 'required|string|max:15',
            'status_verifikasi' => 'required|in:menunggu,terverifikasi,ditolak'
        ]);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $warga->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Warga berhasil diupdate!');
    }

    public function destroyWarga($id)
    {
        Warga::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Warga berhasil dihapus.']);
    }

    // CRUD Petugas
    public function storePetugas(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:6',
            'jabatan' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function updatePetugas(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|unique:petugas,username,'.$id.',id_petugas',
            'jabatan' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Petugas berhasil diupdate!');
    }

    public function destroyPetugas($id)
    {
        Petugas::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Petugas berhasil dihapus.']);
    }
}
