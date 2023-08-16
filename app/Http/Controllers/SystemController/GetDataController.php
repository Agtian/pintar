<?php

namespace App\Http\Controllers\SystemController;

use App\Http\Controllers\Controller;
use App\Models\PGSQL\MasterPegawai;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function getSelectPegawais(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $query = MasterPegawai::orderBy('nama_pegawai', 'asc')->select('nama_pegawai', 'pegawai_id')->limit(20)->distinct()->get();
        } else {
            $query = MasterPegawai::orderBy('nama_pegawai', 'asc')->select('nama_pegawai', 'pegawai_id')->where('nama_pegawai','LIKE','%'.$search.'%')->limit(20)->distinct()->get();
        }

        $response = array();
        foreach($query as $item){
            $response[] = array(
                'id'    => $item->pegawai_id,
                'text'  => $item->nama_pegawai,
            );
        }
        return response()->json($response); 
    }
}
