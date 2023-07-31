<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use App\Models\TransPendaftaranDiklat;
use Illuminate\Http\Request;

class DaftarPesertaController extends Controller
{
    public function index()
    {
        $getDaftarDiklat = TransPendaftaranDiklat::select('kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 'total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            // ->leftJoin('t_peserta_diklat', 't_pendaftaran_diklat.id', '=', 't_peserta_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->paginate(10);
        return view('layouts.diklat.daftar-peserta.index', with([
            'resultDaftarPeserta'   => $getDaftarDiklat,
        ]));
    }
}
