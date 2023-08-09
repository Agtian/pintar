<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransPendaftaranDiklat extends Model
{
    use HasFactory;

    protected $table = 't_pendaftaran_diklat';

    protected $guarded = [];

    public function pendapatanDiklat()
    {
        return $this->hasMany(TransPendapatanDiklat::class, 'id', 'id');
    }
}
