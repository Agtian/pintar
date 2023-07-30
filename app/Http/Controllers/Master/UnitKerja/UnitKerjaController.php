<?php

namespace App\Http\Controllers\Master\UnitKerja;

use App\Http\Controllers\Controller;
use App\Models\MasterUnitKerjaDiklat;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $resultUnitKerja = MasterUnitKerjaDiklat::paginate(10);
        return view('layouts.master.unit-kerja.index', compact('resultUnitKerja'));
    }

    public function create()
    {
        return view('layouts.master.unit-kerja.create');
    }

    public function edit($id)
    {
        $detail = MasterUnitKerjaDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.unit-kerja.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_kerja' => 'required',
        ]);

        MasterUnitKerjaDiklat::create([
            'unit_kerja' => $validatedData['unit_kerja'],
        ]);

        return redirect('dashboard/admin/master-unit-kerja')
                ->with(['success' => 'Unit kerja berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'unit-kerja' => 'required',
        ]);

        MasterUnitKerjaDiklat::findOrFail(base64_decode($id))->update([
            'unit-kerja'  => $validatedData['unit-kerja'],
        ]);

        return redirect('dashboard/admin/master-unit-kerja')
                ->with(['success' => 'Unit kerja berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterUnitKerjaDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Unit kerja berhasil dihapus.');
    }
}
