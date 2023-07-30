<?php

namespace App\Http\Controllers\Master\TarifDiklat;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterJenisPraktikanDiklat;
use App\Models\MasterSatuanKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifDiklatController extends Controller
{
    public function index()
    {
        $resultTarifDiklat = MasterTarifDiklat::paginate(10);
        return view('layouts.master.tarif-diklat.index', compact('resultTarifDiklat'));
    }

    public function create()
    {
        $resultJenisKegiatan    = MasterJenisKegiatanDiklat::all();
        $resultSatuanKegiatan   = MasterSatuanKegiatanDiklat::all();
        $resultJenisPraktikan   = MasterJenisPraktikanDiklat::all();
        return view('layouts.master.tarif-diklat.create', compact('resultJenisKegiatan', 'resultSatuanKegiatan', 'resultJenisPraktikan'));
    }

    public function edit($id)
    {
        $detail = MasterTarifDiklat::findOrFail(base64_decode($id));
        $resultJenisKegiatan    = MasterJenisKegiatanDiklat::all();
        $resultSatuanKegiatan   = MasterSatuanKegiatanDiklat::all();
        $resultJenisPraktikan   = MasterJenisPraktikanDiklat::all();
        return view('layouts.master.tarif-diklat.update', compact('detail', 'resultJenisKegiatan', 'resultSatuanKegiatan', 'resultJenisPraktikan')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_kegiatan_id' => 'required|integer',
            'satuan_kegiatan_id'=> 'required|integer',
            'jenis_praktikan_id'=> 'required|integer',
            'jasa_sarana'       => 'required|integer',
            'jasa_lainnya'      => 'required|integer',
            'jumlah'            => 'required|integer',
            'status_tarif'      => 'required|integer'
        ]);

        MasterTarifDiklat::create([
            'jenis_kegiatan_id'     => $validatedData['jenis_kegiatan_id'],
            'satuan_kegiatan_id'    => $validatedData['satuan_kegiatan_id'],
            'jenis_praktikan_id'    => $validatedData['jenis_praktikan_id'],
            'user_id'               => Auth::user()->id,
            'jasa_sarana'           => $validatedData['jasa_sarana'],
            'jasa_lainnya'          => $validatedData['jasa_lainnya'],
            'jumlah'                => $validatedData['jumlah'],
            'status_tarif'          => $validatedData['status_tarif'],
        ]);

        return redirect('dashboard/admin/master-tarif-diklat')
                ->with(['success' => 'Tarif diklat berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jenis_kegiatan_id' => 'required|integer',
            'satuan_kegiatan_id'=> 'required|integer',
            'jenis_praktikan_id'=> 'required|integer',
            'jasa_sarana'       => 'required|integer',
            'jasa_lainnya'      => 'required|integer',
            'jumlah'            => 'required|integer',
            'status_tarif'      => 'required|integer'
        ]);

        MasterTarifDiklat::findOrFail(base64_decode($id))->update([
            'jenis_kegiatan_id'     => $validatedData['jenis_kegiatan_id'],
            'satuan_kegiatan_id'    => $validatedData['satuan_kegiatan_id'],
            'jenis_praktikan_id'    => $validatedData['jenis_praktikan_id'],
            'user_id'               => Auth::user()->id,
            'jasa_sarana'           => $validatedData['jasa_sarana'],
            'jasa_lainnya'          => $validatedData['jasa_lainnya'],
            'jumlah'                => $validatedData['jumlah'],
            'status_tarif'          => $validatedData['status_tarif'],
        ]);

        return redirect('dashboard/admin/master-tarif-diklat')
                ->with(['success' => 'Tarif diklat berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterTarifDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Tarif diklat berhasil dihapus.');
    }
}