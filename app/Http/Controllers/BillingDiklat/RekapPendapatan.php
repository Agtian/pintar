<?php

namespace App\Http\Controllers\BillingDiklat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapPendapatan extends Controller
{
    public function index()
    {
        return view('layouts.billing-diklat.rekap-pendapatan.index');
    }
}
