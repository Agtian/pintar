<?php

namespace App\Http\Controllers\Master\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\PGSQL\MasterPegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('layouts.master.pegawai.index');
    }
}
