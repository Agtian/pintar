<?php

namespace App\Http\Controllers\Master\JenisKegiatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKegiatanDiklat;
use Illuminate\Http\Request;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $resultJenisKegiatan = MasterJenisKegiatanDiklat::paginate(10);
        return view('layouts.master.jenis-kegiatan.index', compact('resultJenisKegiatan'));
    }

    public function create()
    {
        return view('layouts.master.jenis-kegiatan.create');
    }

    public function edit($id)
    {
        $detail = MasterJenisKegiatanDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.jenis-kegiatan.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required',
        ]);

        MasterJenisKegiatanDiklat::create([
            'nama_kegiatan' => $validatedData['nama_kegiatan'],
        ]);

        return redirect('dashboard/admin/master-jenis-kegiatan')
                ->with(['success' => 'Jenis kegiatan berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required',
        ]);

        MasterJenisKegiatanDiklat::findOrFail(base64_decode($id))->update([
            'nama_kegiatan'  => $validatedData['nama_kegiatan'],
        ]);

        return redirect('dashboard/admin/master-jenis-kegiatan')
                ->with(['success' => 'Jenis kegiatan berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterJenisKegiatanDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Jenis kegiatan berhasil dihapus.');
    }
}
