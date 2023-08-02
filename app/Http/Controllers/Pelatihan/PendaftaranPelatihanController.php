<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\MasterAcaraDiklat;
use App\Models\TransPendaftaranDiklat;
use Illuminate\Http\Request;

class PendaftaranPelatihanController extends Controller
{
    public function getKuotaPendaftarPelatihan($id)
    {
        $query = TransPendaftaranDiklat::where('acara_diklat_id', $id)->get();
        return $query->count();
    }

    public function index()
    {
        $resultAcaraPelatihan = MasterAcaraDiklat::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('layouts.pelatihan.pendaftaran-pelatihan.index', compact('resultAcaraPelatihan'));
    }

    public function registrasi($id)
    {
        $detail                 = MasterAcaraDiklat::findOrFail(base64_decode($id));
        $sisa_kuota_pendaftar   = $detail->role_max_peserta - $this->getKuotaPendaftarPelatihan(base64_decode($id));
        return view('layouts.pelatihan.pendaftaran-pelatihan.registrasi', compact('detail', 'sisa_kuota_pendaftar'));
    }
}
