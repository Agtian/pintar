<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterUnitKerjaDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranDiklatController extends Controller
{
    public function index()
    {
        $resultUnitKerja = MasterUnitKerjaDiklat::all();
        $resultJenisKegiatan = MasterJenisKegiatanDiklat::all();

        $query = MasterTarifDiklat::select('jenis_praktikan_id', 'jenis_praktikan')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->where('m_tarif_diklat.satuan_kegiatan_id', 2)
                    ->distinct()
                    ->get();

        return view('layouts.diklat.pendaftaran-diklat.index', compact('resultUnitKerja', 'resultJenisKegiatan'));
    }
}
