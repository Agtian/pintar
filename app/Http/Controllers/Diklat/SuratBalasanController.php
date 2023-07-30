<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratBalasanController extends Controller
{
    public function index()
    {
        return view('layouts.diklat.surat-balasan.index');
    }
}
