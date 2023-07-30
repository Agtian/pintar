<?php

namespace App\Http\Controllers\Master\HonorariumDiklat;

use App\Http\Controllers\Controller;
use App\Models\MasterHonorariumDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorariumDiklatController extends Controller
{
    public function index()
    {
        $resultHonorarium = MasterHonorariumDiklat::paginate(10);
        return view('layouts.master.tarif-honorarium.index', compact('resultHonorarium'));
    }

    public function create()
    {
        return view('layouts.master.tarif-honorarium.create');
    }

    public function edit($id)
    {
        $detail = MasterHonorariumDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.tarif-honorarium.update', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan'        => 'required',
            'tarif_honorarium'  => 'required|integer'
        ]);

        MasterHonorariumDiklat::create([
            'user_id'               => Auth::user()->id,
            'keterangan_honorarium' => $validatedData['keterangan'],
            'tarif_honorarium'      => $validatedData['tarif_honorarium'],
        ]);

        return redirect('dashboard/admin/master-honorarium')
                ->with(['success' => 'Tarif honorarium berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'keterangan'        => 'required',
            'tarif_honorarium'  => 'required|integer'
        ]);

        MasterHonorariumDiklat::findOrFail(base64_decode($id))->update([
            'user_id'               => Auth::user()->id,
            'keterangan_honorarium' => $validatedData['keterangan'],
            'tarif_honorarium'      => $validatedData['tarif_honorarium'],
        ]);

        return redirect('dashboard/admin/master-honorarium')
                ->with(['success' => 'Tarif honorarium berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        MasterHonorariumDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Tarif honorarium berhasil dihapus.');
    }
}
