<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransPendapatanDiklat extends Model
{
    use HasFactory;

    public $table = 't_pendapatan_diklat';

    protected $guarded = [];

    public function getPendapatanDiklat()
    {
        $query = DB::table('t_pendapatan_diklat')
                    ->join('t_pendaftaran_diklat', 't_pendapatan_diklat.pendaftaran_diklat_id', '=', 't_pendaftaran_diklat.id')
                    ->leftJoin('t_surat_diklat', 't_pendapatan_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                    ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                    ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                    ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->leftJoin('users as users_bill', 't_pendapatan_diklat.user_validated_id', '=', 'users_bill.id')
                    ->join('users as users_reg', 't_pendapatan_diklat.user_id', '=', 'users_reg.id')
                    ->select('t_pendapatan_diklat.id', 't_pendapatan_diklat.jasa_sarana', 't_pendapatan_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 't_pendapatan_diklat.tarif_honorarium', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.jumlah_peserta', 't_pendapatan_diklat.total_waktu', 't_pendapatan_diklat.tarif_pre_klinik', 't_pendapatan_diklat.total_tarif', 't_pendapatan_diklat.f_status', 't_pendaftaran_diklat.kode_pendaftaran', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 't_pendapatan_diklat.tgl_bayar', 't_pendaftaran_diklat.status_pendaftaran', 't_surat_diklat.no_surat_diklat', 't_surat_diklat.nama_instansi', 'm_tarif_diklat.no_pergub_tarif', 'm_jenis_kegiatan.nama_kegiatan', 'm_satuan_kegiatan.alias', 'm_jenis_praktikan.jenis_praktikan', 'users_bill.name as name_bill', 'users_reg.name as name_reg')
                    ->orderBy('t_pendapatan_diklat.id', 'DESC')
                    ->paginate(10);

        return $query;
    }

    public function getFilterPendapatanDiklat($tgl_awal, $tgl_akhir, $status_bill)
    {
        if ($status_bill == 'viewAll') {
            $query = DB::table('t_pendapatan_diklat')
                    ->join('t_pendaftaran_diklat', 't_pendapatan_diklat.pendaftaran_diklat_id', '=', 't_pendaftaran_diklat.id')
                    ->leftJoin('t_surat_diklat', 't_pendapatan_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                    ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                    ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                    ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->leftJoin('users as users_bill', 't_pendapatan_diklat.user_validated_id', '=', 'users_bill.id')
                    ->join('users as users_reg', 't_pendapatan_diklat.user_id', '=', 'users_reg.id')
                    ->select('t_pendapatan_diklat.id', 't_pendapatan_diklat.jasa_sarana', 't_pendapatan_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 't_pendapatan_diklat.tarif_honorarium', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.jumlah_peserta', 't_pendapatan_diklat.total_waktu', 't_pendapatan_diklat.tarif_pre_klinik', 't_pendapatan_diklat.total_tarif', 't_pendapatan_diklat.f_status', 't_pendaftaran_diklat.kode_pendaftaran', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 't_pendapatan_diklat.tgl_bayar', 't_pendaftaran_diklat.status_pendaftaran', 't_surat_diklat.no_surat_diklat', 't_surat_diklat.nama_instansi', 'm_tarif_diklat.no_pergub_tarif', 'm_jenis_kegiatan.nama_kegiatan', 'm_satuan_kegiatan.alias', 'm_jenis_praktikan.jenis_praktikan', 'users_bill.name as name_bill', 'users_reg.name as name_reg')
                    ->whereBetween('t_pendaftaran_diklat.tgl_pendaftaran', [$tgl_awal, $tgl_akhir])
                    ->orderBy('t_pendapatan_diklat.id', 'DESC')
                    ->get();
        } else {
            $query = DB::table('t_pendapatan_diklat')
                    ->join('t_pendaftaran_diklat', 't_pendapatan_diklat.pendaftaran_diklat_id', '=', 't_pendaftaran_diklat.id')
                    ->leftJoin('t_surat_diklat', 't_pendapatan_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                    ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                    ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                    ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->leftJoin('users as users_bill', 't_pendapatan_diklat.user_validated_id', '=', 'users_bill.id')
                    ->join('users as users_reg', 't_pendapatan_diklat.user_id', '=', 'users_reg.id')
                    ->select('t_pendapatan_diklat.id', 't_pendapatan_diklat.jasa_sarana', 't_pendapatan_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 't_pendapatan_diklat.tarif_honorarium', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.jumlah_peserta', 't_pendapatan_diklat.total_waktu', 't_pendapatan_diklat.tarif_pre_klinik', 't_pendapatan_diklat.total_tarif', 't_pendapatan_diklat.f_status', 't_pendaftaran_diklat.kode_pendaftaran', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 't_pendapatan_diklat.tgl_bayar', 't_pendaftaran_diklat.status_pendaftaran', 't_surat_diklat.no_surat_diklat', 't_surat_diklat.nama_instansi', 'm_tarif_diklat.no_pergub_tarif', 'm_jenis_kegiatan.nama_kegiatan', 'm_satuan_kegiatan.alias', 'm_jenis_praktikan.jenis_praktikan', 'users_bill.name as name_bill', 'users_reg.name as name_reg')
                    ->whereBetween('t_pendaftaran_diklat.tgl_pendaftaran', [$tgl_awal, $tgl_akhir])
                    ->where('t_pendapatan_diklat.f_status', $status_bill)
                    ->orderBy('t_pendapatan_diklat.id', 'DESC')
                    ->get();
        }

        return $query;
    }
}
