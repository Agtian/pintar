<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransPendapatanDiklat extends Model
{
    use HasFactory;

    protected $table = 't_pendapatan_diklat';

    protected $guarded = [];

    public function pendaftaranDiklat()
    {
        return $this->belongsTo(TransPendaftaranDiklat::class, 'pendaftaran_diklat_id', 'id');
    }

    public function suratDiklat()
    {
        return $this->belongsTo(TransSuratDiklat::class);
    }

    public function tarifDiklat()
    {
        return $this->belongsTo(MasterTarifDiklat::class);
    }

    public function honorariumDiklat()
    {
        return $this->belongsTo(MasterHonorariumDiklat::class, 'honorarium_diklat_id', 'id');
    }
}
