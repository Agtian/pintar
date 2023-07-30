<?php

namespace App\Http\Controllers\Master\SatuanKegiatan;

use App\Http\Controllers\Controller;
use App\Models\MasterSatuanKegiatanDiklat;
use Illuminate\Http\Request;

class SatuanKegiatanController extends Controller
{
    public function index()
    {
        $resultSatuanKegiatan = MasterSatuanKegiatanDiklat::paginate(10);
        return view('layouts.master.satuan-kegiatan.index', compact('resultSatuanKegiatan'));
    }

    public function create()
    {
        return view('layouts.master.satuan-kegiatan.create');
    }

    public function edit($id)
    {
        $detail = MasterSatuanKegiatanDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.satuan-kegiatan.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'satuan_kegiatan' => 'required',
        ]);

        MasterSatuanKegiatanDiklat::create([
            'satuan_kegiatan' => $validatedData['satuan_kegiatan'],
        ]);

        return redirect('dashboard/admin/master-satuan-kegiatan')
                ->with(['success' => 'Satuan kegiatan berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'satuan_kegiatan' => 'required',
        ]);

        MasterSatuanKegiatanDiklat::findOrFail(base64_decode($id))->update([
            'satuan_kegiatan'  => $validatedData['satuan_kegiatan'],
        ]);

        return redirect('dashboard/admin/master-satuan-kegiatan')
                ->with(['success' => 'Satuan kegiatan berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterSatuanKegiatanDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Satuan kegiatan berhasil dihapus.');
    }
}
