<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnitKerja extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'public.unitkerja_m';
    protected $primaryKey = 'unitkerja_id';
    protected $guarded = [];

    public function pegawais()
    {
        return $this->hasMany(MasterPegawai::class, 'unitkerja_id', 'unitkerja_id');
    }
}
