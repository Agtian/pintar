<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransSuratDiklat extends Model
{
    use HasFactory;

    protected $table = 't_surat_diklat';

    protected $guarded = [];

    public function getDetailSuratBalasan($kode)
    {
        $query = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 't_pendaftaran_diklat.surat_diklat_id', 't_pendaftaran_diklat.acara_diklat_id', 't_pendaftaran_diklat.jumlah_peserta_tambahan', 't_pendaftaran_diklat.tgl_pendaftaran','kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 't_pendapatan_diklat.total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 'file_surat_permohonan', 'tarif_pre_klinik')
                    ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                    ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                    ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                    ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                    ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->where('t_pendaftaran_diklat.id', $kode)
                    ->first();

        return $query;
    }
}
