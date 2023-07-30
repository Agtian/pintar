<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use App\Models\MasterTarifDiklat;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function getSatuanKegiatan(Request $request)
    {
        $data['satuan_kegiatan'] = MasterTarifDiklat::select('satuan_kegiatan_id', 'alias')
                                    ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                                    ->where('m_tarif_diklat.jenis_kegiatan_id', $request->jenis_kegiatan_id)
                                    ->distinct()
                                    ->get();

        return response()->json($data);
    }

    public function getJenisPraktikan(Request $request)
    {
        $data['jenis_praktikans'] = MasterTarifDiklat::select('jenis_praktikan_id', 'jenis_praktikan')
                                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                                    ->where('m_tarif_diklat.satuan_kegiatan_id', $request->satuan_kegiatan_id)
                                    ->distinct()
                                    ->get();

        return response()->json($data);
    }
}
