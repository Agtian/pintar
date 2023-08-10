<?php

namespace App\Http\Controllers\BillingDiklat;

use App\Http\Controllers\Controller;
use App\Models\TransPendapatanDiklat;
use Illuminate\Http\Request;

class RekapPendapatan extends Controller
{
    public function index()
    {
        return view('layouts.billing-diklat.rekap-pendapatan.index',with([
            'resultRekapPendapatan' => (new TransPendapatanDiklat())->getPendapatanDiklat(),
        ]));
    }

    public function filter(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_awal'      => 'required',
            'tgl_akhir'     => 'required',
            'status_bill'   => 'required',
        ]);

        return view('layouts.billing-diklat.rekap-pendapatan.filter',with([
            'resultRekapPendapatan' => (new TransPendapatanDiklat())->getFilterPendapatanDiklat($validatedData['tgl_awal'], $validatedData['tgl_akhir'], $validatedData['status_bill']),
            'tgl_awal'              => date('d/m/Y', strtotime($validatedData['tgl_awal'])),
            'tgl_akhir'             => date('d/m/Y', strtotime($validatedData['tgl_akhir'])),
            'status_bill'           => $validatedData['status_bill'] == 0 ? 'Belum lunas' : ($validatedData['status_bill'] == 1 ? 'Lunas' : ($validatedData['status_bill'] == 2 ? 'Batal' : ($validatedData['status_bill'] == 3 ? 'Pending' : 'Tampilkan semua data'))),
        ]));
    }
}
