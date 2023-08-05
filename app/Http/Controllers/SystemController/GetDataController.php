<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use App\Models\TransPesertaDiklat;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function getTablePesertaDiklat(Request $request)
    {
        dd($request);
        return TransPesertaDiklat::where('pendaftaran_diklat_id', $request->pendaftaran_diklat_id)->get();
    }
}
