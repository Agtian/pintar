<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterTarifPelatihanPreKlinik;
use App\Models\MasterUnitKerjaDiklat;
use Illuminate\Http\Request;

class PendaftaranDiklatMOUController extends Controller
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

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
            $jumlah_tarif = 0;
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif = number_format($item->jumlah_tarif, 2, '.',',');
        }

        return view('layouts.diklat.pendaftaran-diklat-mou.index', compact('resultUnitKerja', 'resultJenisKegiatan', 'jumlah_tarif'));
    }
}
