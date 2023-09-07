<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user petugas_diklat
                return redirect()->intended('/dashboard');

            } elseif (auth()->user()->role_id === 2) {
                // jika user admin
                return redirect()->intended('/administrator/dashboard');

            } elseif (auth()->user()->role_id === 3) {
                // jika user kasir
                return redirect()->intended('/dashboard-cashier');

            } elseif (auth()->user()->role_id === 4) {
                // jika user peserta_mou
                return redirect()->intended('/dashboard-institutions');

            } elseif (auth()->user()->role_id === 5) {
                // jika user peserta_diklat
                return redirect()->intended('/administrator/dashboard');

            } else {
                // jika tidak ada akses
                return back()->with('error', 'anda tidak memiliki akses.');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request) {

        dd($request);
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
