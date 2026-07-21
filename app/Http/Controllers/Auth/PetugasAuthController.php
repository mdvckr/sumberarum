<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.petugas.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $petugas = Petugas::where('username', $request->username)->first();

        if (!$petugas || !Hash::check($request->password, $petugas->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        Auth::guard('petugas')->login($petugas);
        return redirect()->route('petugas.dashboard');
    }

    public function logout()
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('petugas.login');
    }

    public function showRegister()
    {
        return view('auth.petugas.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:petugas,username',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('petugas.login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
