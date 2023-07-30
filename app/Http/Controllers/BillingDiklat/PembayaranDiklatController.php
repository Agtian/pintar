<?php

namespace App\Http\Controllers\BillingDiklat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranDiklatController extends Controller
{
    public function index()
    {
        return view('layouts.billing-diklat.pembayaran.index');
    }
}
