<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisPraktikanDiklat extends Model
{
    use HasFactory;

    protected $table = 'm_jenis_praktikan';

    protected $guarded = [];

    public function get_tarif_diklat()
    {
        return $this->hasOne(MasterTarifDiklat::class);
    }
}
