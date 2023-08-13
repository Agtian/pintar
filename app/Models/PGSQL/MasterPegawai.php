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
