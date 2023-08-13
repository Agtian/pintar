<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGelarBelakang extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'public.gelarbelakang_m';

    protected $primaryKey = 'gelarbelakang_id';

    protected $guarded = [];

    public function pegawais()
    {
        return $this->hasMany(MasterPegawai::class, 'gelarbelakang_id', 'gelarbelakang_id');
    }
}
