<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranPelatihanController extends Controller
{
    public function index()
    {
        return view('layouts.pelatihan.pendaftaran-pelatihan.index');
    }
}
