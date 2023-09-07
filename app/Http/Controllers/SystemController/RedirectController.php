<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek() 
    {
        dd(auth()->user()->role_id);

        if (auth()->user()->role_id == 1) {
            // jika user petugas_diklat
            return redirect('/dashboard');

        } elseif (auth()->user()->role_id == 2) {
            // jika user admin
            return redirect('/administrator/dashboard');

        } elseif (auth()->user()->role_id == 3) {
            // jika user kasir
            return redirect('/administrator/dashboard');

        } elseif (auth()->user()->role_id == 4) {
            // jika user peserta_mou
            return redirect('/administrator/dashboard');

        } elseif (auth()->user()->role_id == 5) {
            // jika user peserta_diklat
            return redirect('/administrator/dashboard');

        }
    }
}
