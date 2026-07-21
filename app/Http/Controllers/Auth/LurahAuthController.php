<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LurahAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.lurah.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('lurah')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('lurah.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('lurah')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('lurah.login');
    }
}
