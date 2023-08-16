<?php

namespace App\Http\Controllers\Master\DaftarMOU;

use App\Http\Controllers\Controller;
use App\Models\MasterDaftarMOUDiklat;
use Illuminate\Http\Request;

class DaftarMOUController extends Controller
{
    public function index()
    {
        $resuldDaftarMOU = MasterDaftarMOUDiklat::paginate(10);
        return view('layouts.master.daftar-mou.index', compact('resuldDaftarMOU'));
    }

    public function create()
    {
        return view('layouts.master.daftar-mou.create');
    }

    public function edit($id)
    {
        $detail = MasterDaftarMOUDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.daftar-mou.update', compact('detail')); 
    }

    public function akses($id)
    {
        $detail = MasterDaftarMOUDiklat::findOrFail(base64_decode($id));
        return view('layouts.master.daftar-mou.akses', compact('detail')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat'          => 'required|string',
            'no_mou'            => 'nullable|string',
            'tgl_mou'           => 'required|date',
            'bidang_kerjasama'  => 'required|string',
            'nama_instansi'     => 'required|string',
            'kota_instansi'     => 'required|string',
            'nama_ttd_mou'      => 'required|string',
            'nip_tdd_mou'       => 'required|string',
            'jabatan_tdd_mou'   => 'required|string',
            'jangka_waktu_tahun' => 'required',
            'tgl_mulai_mou'     => 'required|date',
            'tgl_akhir_mou'     => 'required|date',
        ]);

        MasterDaftarMOUDiklat::create([
            'no_surat'          => $validatedData['no_surat'],
            'no_mou'            => '',
            'tgl_mou'           => $validatedData['tgl_mou'],
            'bidang_kerjasama'  => $validatedData['bidang_kerjasama'],
            'nama_instansi'     => $validatedData['nama_instansi'],
            'kota_instansi'     => $validatedData['kota_instansi'],
            'nama_ttd_mou'      => $validatedData['nama_ttd_mou'],
            'nip_tdd_mou'       => $validatedData['nip_tdd_mou'],
            'jabatan_tdd_mou'   => $validatedData['jabatan_tdd_mou'],
            'jangka_waktu_tahun' => $validatedData['jangka_waktu_tahun'],
            'tgl_mulai_mou'     => $validatedData['tgl_mulai_mou'],
            'tgl_akhir_mou'     => $validatedData['tgl_akhir_mou'],
            'status_mou'        => 1,
            'status_akses'      => 1,
        ]);

        return redirect('dashboard/admin/master-daftar-mou')
                ->with(['success' => 'Data MOU berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_surat'          => 'required|string',
            'no_mou'            => '',
            'tgl_mou'           => 'required|date',
            'bidang_kerjasama'  => 'required|string',
            'nama_instansi'     => 'required|string',
            'kota_instansi'     => 'required|string',
            'nama_ttd_mou'      => 'required|string',
            'nip_tdd_mou'       => 'required|string',
            'jabatan_tdd_mou'   => 'required|string',
            'jangka_waktu_tahun' => 'required|integer',
            'tgl_mulai_mou'     => 'required|date',
            'tgl_akhir_mou'     => 'required|date',
            'status_mou'        => 'required|integer',
        ]);

        MasterDaftarMOUDiklat::findOrFail(base64_decode($id))->update([
            'no_surat'          => $validatedData['no_surat'],
            'no_mou'            => '',
            'tgl_mou'           => $validatedData['tgl_mou'],
            'bidang_kerjasama'  => $validatedData['bidang_kerjasama'],
            'nama_instansi'     => $validatedData['nama_instansi'],
            'kota_instansi'     => $validatedData['kota_instansi'],
            'nama_ttd_mou'      => $validatedData['nama_ttd_mou'],
            'nip_tdd_mou'       => $validatedData['nip_tdd_mou'],
            'jabatan_tdd_mou'   => $validatedData['jabatan_tdd_mou'],
            'jangka_waktu_tahun' => $validatedData['jangka_waktu_tahun'],
            'tgl_mulai_mou'     => $validatedData['tgl_mulai_mou'],
            'tgl_akhir_mou'     => $validatedData['tgl_akhir_mou'],
            'status_mou'        => $validatedData['status_mou'],
        ]);

        return redirect('dashboard/admin/master-daftar-mou')
                ->with(['success' => 'Data MOU berhasil diperbarui.']);
    }
    public function destroy($id)
    {
        MasterDaftarMOUDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('success', 'Data MOU berhasil dihapus.');
    }
}
