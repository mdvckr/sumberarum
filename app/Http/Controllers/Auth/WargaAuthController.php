<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WargaAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.warga.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik'      => 'required|digits:16|unique:warga,nik',
            'no_kk'    => 'required|digits:16',
            'nama'     => 'required|string|max:100',
            'alamat'   => 'required|string',
            'rt'       => 'required|string|max:5',
            'rw'       => 'required|string|max:5',
            'email'    => 'required|email|unique:warga,email',
            'password' => 'required|min:6|confirmed',
            'no_hp'    => 'required|string|max:15',
        ]);

        Warga::create([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'status_verifikasi' => 'menunggu',
        ]);

        return redirect()->route('warga.login')->with('success', 'Registrasi berhasil! Silakan tunggu verifikasi admin sebelum login.');
    }

    public function showLogin()
    {
        return view('auth.warga.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $warga = Warga::where('email', $request->email)->first();

        if (!$warga || !Hash::check($request->password, $warga->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        if ($warga->status_verifikasi !== 'terverifikasi') {
            return back()->withErrors(['email' => 'Akun kamu belum diverifikasi oleh admin kelurahan.'])->withInput();
        }

        Auth::guard('warga')->login($warga);
        return redirect()->route('warga.dashboard');
    }

    public function logout()
    {
        Auth::guard('warga')->logout();
        return redirect()->route('warga.login');
    }
}
