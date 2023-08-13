<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use App\Models\PGSQL\MasterPegawai;
use App\Models\TransPesertaDiklat;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function getSelectPegawais($search)
    {
        $query = MasterPegawai::where('nama_pegawai','LIKE','%'.$search.'%')->get();

        foreach ($query as $item) {
            $data = [
                'id'            => $item->pegawai_id,
                'nama_pegawai'  => $item->nama_pegawai,
            ];
        }

        return json_encode($data);
    }
}
