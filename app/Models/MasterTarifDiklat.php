<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTarifDiklat extends Model
{
    use HasFactory;

    protected $table = 'm_tarif_diklat';

    protected $guarded = [];

    public function get_jenis_kegiatan()
    {
        return $this->belongsTo(MasterJenisKegiatanDiklat::class, 'jenis_kegiatan_id', 'id');
    }

    public function get_satuan_kegiatan()
    {
        return $this->belongsTo(MasterSatuanKegiatanDiklat::class, 'satuan_kegiatan_id', 'id');
    }

    public function get_jenis_praktikan()
    {
        return $this->belongsTo(MasterJenisPraktikanDiklat::class, 'jenis_praktikan_id', 'id');
    }
}
