<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterPegawai extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'public.pegawai_m';
    protected $primaryKey = 'pegawai_id';
    public $timestamps = false;
    protected $guarded = [];

    public function getAllPegawais()
    {
        $query = DB::connection('pgsql')->table('public.pegawai_m')
                                ->leftJoin('gelarbelakang_m', 'pegawai_m.gelarbelakang_id', '=', 'gelarbelakang_m.gelarbelakang_id')
                                ->leftJoin('pangkat_m', 'pegawai_m.pangkat_id', '=', 'pangkat_m.pangkat_id')
                                ->leftJoin('golonganpegawai_m', 'pangkat_m.golonganpegawai_id', '=', 'golonganpegawai_m.golonganpegawai_id')
                                ->select('pegawai_m.gelardepan','pegawai_m.nama_pegawai', 'pegawai_m.nomorindukpegawai', 'gelarbelakang_m.gelarbelakang_nama')
                                ->limit(50)
                                ->get();
        return $query;
    }

    public function getSearchPegawai($pegawai_id)
    {
        $query = DB::connection('pgsql')->table('public.pegawai_m')
                                ->where('pegawai_id', $pegawai_id)
                                ->leftJoin('gelarbelakang_m', 'pegawai_m.gelarbelakang_id', '=', 'gelarbelakang_m.gelarbelakang_id')
                                ->leftJoin('pangkat_m', 'pegawai_m.pangkat_id', '=', 'pangkat_m.pangkat_id')
                                ->leftJoin('golonganpegawai_m', 'pangkat_m.golonganpegawai_id', '=', 'golonganpegawai_m.golonganpegawai_id')
                                ->leftJoin('unitkerja_m', 'pegawai_m.unitkerja_id', '=', 'unitkerja_m.unitkerja_id')
                                ->leftJoin('pendidikan_m', 'pegawai_m.pendidikan_id', '=', 'pendidikan_m.pendidikan_id')
                                ->leftJoin('jabatan_m', 'pegawai_m.jabatan_id', '=', 'jabatan_m.jabatan_id')
                                ->leftJoin('pendidikankualifikasi_m', 'pegawai_m.pendkualifikasi_id', '=', 'pendidikankualifikasi_m.pendkualifikasi_id')
                                ->leftJoin('kelompokpegawai_m', 'pegawai_m.kelompokpegawai_id', '=', 'kelompokpegawai_m.kelompokpegawai_id')
                                ->select('pegawai_m.pegawai_id','pegawai_m.gelardepan','pegawai_m.nama_pegawai', 'gelarbelakang_m.gelarbelakang_nama', 'pegawai_m.nomorindukpegawai', 'pegawai_m.jeniskelamin', 'pegawai_m.tempatlahir_pegawai', 'pegawai_m.tgl_lahirpegawai', 'pegawai_m.pegawai_aktif', 'pegawai_m.agama', 'pegawai_m.golongandarah', 'pegawai_m.alamatemail', 'pegawai_m.notelp_pegawai', 'nomobile_pegawai', 'pegawai_m.photopegawai', 'namaunitkerja', 'pendidikan_nama', 'jabatan_nama', 'pangkat_nama', 'pendkualifikasi_nama', 'golonganpegawai_nama', 'kelompokpegawai_nama',  'gelarbelakang_m.gelarbelakang_nama')
                                ->first();
        return $query;
    }

    public function unitkerjas()
    {
        return $this->belongsTo(MasterUnitKerja::class, 'unitkerja_id', 'unitkerja_id');
    }

    public function gelarbelakangs()
    {
        return $this->belongsTo(MasterGelarBelakang::class, 'gelarbelakang_id', 'gelarbelakang_id');
    }

    public function jabatans()
    {
        return $this->belongsTo(MasterJabatan::class, 'jabatan_id', 'jabatan_id');
    }
}
