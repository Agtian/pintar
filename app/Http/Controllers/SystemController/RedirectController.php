<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek() {
        if (auth()->user()->role_id === 1) {
            // jika user petugas_diklat
            return redirect()->intended('/dashboard');

        } elseif (auth()->user()->role_id === 2) {
            // jika user admin
            return redirect()->intended('/administrator/dashboard');

        } elseif (auth()->user()->role_id === 3) {
            // jika user kasir
            return redirect()->intended('/administrator/dashboard');

        } elseif (auth()->user()->role_id === 4) {
            // jika user peserta_mou
            return redirect()->intended('/administrator/dashboard');

        } elseif (auth()->user()->role_id === 5) {
            // jika user peserta_diklat
            return redirect()->intended('/administrator/dashboard');

        } else {
            // jika tidak ada akses
            return redirect('/dashboard');
        }
    }
}
