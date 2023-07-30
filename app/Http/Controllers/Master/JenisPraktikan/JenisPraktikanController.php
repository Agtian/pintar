<?php

namespace App\Http\Controllers\Master\JenisPraktikan;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisPraktikanDiklat;
use Illuminate\Http\Request;

class JenisPraktikanController extends Controller
{
    public function index()
    {
        $resultJenisPraktikan =  MasterJenisPraktikanDiklat::paginate(10);
        return view('layouts.master.jenis-praktikan.index', compact('resultJenisPraktikan'));
    }

    public function create()
    {
        return view('layouts.master.jenis-praktikan.create');
    }

    public function edit($id)
    {
        $detail = MasterJenisPraktikanDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.jenis-praktikan.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_praktikan' => 'required',
        ]);

        MasterJenisPraktikanDiklat::create([
            'jenis_praktikan' => $validatedData['jenis_praktikan'],
        ]);

        return redirect('dashboard/admin/master-jenis-praktikan')
                ->with(['success' => 'Jenis praktikan berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jenis_praktikan' => 'required',
        ]);

        MasterJenisPraktikanDiklat::findOrFail(base64_decode($id))->update([
            'jenis_praktikan'  => $validatedData['jenis_praktikan'],
        ]);

        return redirect('dashboard/admin/master-jenis-praktikan')
                ->with(['success' => 'Jenis praktikan berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterJenisPraktikanDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Jenis praktikan berhasil dihapus.');
    }
}
