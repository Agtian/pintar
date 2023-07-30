<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarPesertaController extends Controller
{
    public function index()
    {
        return view('layouts.diklat.daftar-peserta.index');
    }
}
