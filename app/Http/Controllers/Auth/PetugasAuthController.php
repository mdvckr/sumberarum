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
}
