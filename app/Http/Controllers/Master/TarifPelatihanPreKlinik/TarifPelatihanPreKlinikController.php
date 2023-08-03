<?php

namespace App\Http\Controllers\Master\TarifPelatihanPreKlinik;

use App\Http\Controllers\Controller;
use App\Models\MasterTarifPelatihanPreKlinik;
use Illuminate\Http\Request;

class TarifPelatihanPreKlinikController extends Controller
{
    public function index()
    {
        $resultTarifPelatihanPreKlinik = MasterTarifPelatihanPreKlinik::paginate(10);
        return view('layouts.master.tarif-pelatihan-pre-klinik.index', compact('resultTarifPelatihanPreKlinik'));
    }

    public function create()
    {
        return view('layouts.master.tarif-pelatihan-pre-klinik.create');
    }

    public function edit($id)
    {
        $detail = MasterTarifPelatihanPreKlinik::findOrFail(base64_decode($id));
        return view('layouts.master.tarif-pelatihan-pre-klinik.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_perdir'         => 'required',
            'jasa_sarana'       => 'required|integer',
            'jasa_pelayanan'    => 'required|integer',
            'jumlah_tarif'      => 'required|integer',
            'status_tarif'      => 'required|integer',
        ]);

        MasterTarifPelatihanPreKlinik::create([
            'no_perdir'         => $validatedData['no_perdir'],
            'jasa_sarana'       => $validatedData['jasa_sarana'],
            'jasa_pelayanan'    => $validatedData['jasa_pelayanan'],
            'jumlah_tarif'      => $validatedData['jumlah_tarif'],
            'status_tarif'      => $validatedData['status_tarif'],
        ]);

        return redirect('dashboard/admin/master-tarif-pelatihan-pre-klinik')
                ->with(['success' => 'Tarif pelatihan pre klinik berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_perdir'         => 'required',
            'jasa_sarana'       => 'required|integer',
            'jasa_pelayanan'    => 'required|integer',
            'jumlah_tarif'      => 'required|integer',
            'status_tarif'      => 'required|integer',
        ]);

        MasterTarifPelatihanPreKlinik::findOrFail(base64_decode($id))->update([
            'no_perdir'         => $validatedData['no_perdir'],
            'jasa_sarana'       => $validatedData['jasa_sarana'],
            'jasa_pelayanan'    => $validatedData['jasa_pelayanan'],
            'jumlah_tarif'      => $validatedData['jumlah_tarif'],
            'status_tarif'      => $validatedData['status_tarif'],
        ]);

        return redirect('dashboard/admin/master-tarif-pelatihan-pre-klinik')
                ->with(['success' => 'Tarif pelatihan pre klinik berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterTarifPelatihanPreKlinik::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Tarif pelatihan pre klinik berhasil dihapus.');
    }
}
