<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPegawaiTemp;
use App\Models\PGSQL\MasterPegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('layouts.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('layouts.admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai_id'=> 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'role_as'   => 'required',
        ]);

        $insertUsers = User::create([
            'name'      => $validatedData['pegawai_id'],
            'email'     => $validatedData['email'],
            'password'  => Hash::make($validatedData['password']),
            'role_as'   => $validatedData['role_as'],
            'status_user' => 1
        ]);

        $getPegawai = (new MasterPegawai())->getSearchPegawai($validatedData['pegawai_id']);

        MasterPegawaiTemp::create([
            'pegawai_id'            => $getPegawai->pegawai_id,
            'gelardepan'            => $getPegawai->gelardepan,
            'nama_pegawai'          => $getPegawai->nama_pegawai,
            'gelarbelakang_nama'    => $getPegawai->gelarbelakang_nama,
            'nomorindukpegawai'     => $getPegawai->nomorindukpegawai,
            'jeniskelamin'          => $getPegawai->jeniskelamin,
            'tempatlahir_pegawai'   => $getPegawai->tempatlahir_pegawai,
            'tgl_lahirpegawai'      => $getPegawai->tgl_lahirpegawai,
            'pegawai_aktif'         => $getPegawai->pegawai_aktif,
            'agama'                 => $getPegawai->agama,
            'golongandarah'         => $getPegawai->golongandarah,
            'alamatemail'           => $getPegawai->alamatemail,
            'notelp_pegawai'        => $getPegawai->notelp_pegawai,
            'nomobile_pegawai'      => $getPegawai->nomobile_pegawai,
            'photopegawai'          => $getPegawai->photopegawai,
            'namaunitkerja'         => $getPegawai->namaunitkerja,
            'pendidikan_nama'       => $getPegawai->pendidikan_nama,
            'jabatan_nama'          => $getPegawai->jabatan_nama,
            'pangkat_nama'          => $getPegawai->pangkat_nama,
            'pendkualifikasi_nama'  => $getPegawai->pendkualifikasi_nama,
            'golonganpegawai_nama'  => $getPegawai->golonganpegawai_nama,
            'kelompokpegawai_nama'  => $getPegawai->kelompokpegawai_nama,
        ]);

        return redirect('dashboard/admin/user/create')->with('message', 'User added successfully.');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('layouts.admin.user.edit', compact('user'));
    }

    public function update(Request $request, int $user_id)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required|confirmed',
            'role_as'   => 'required',
        ]);

        $user = User::findOrFail($user_id);
        $user->update([
            'name'      => $validatedData['name'],
            'email'     => $validatedData['email'],
            'password'  => $validatedData['password'],
            'role_as'   => $validatedData['role_as'],
        ]);

        return redirect('/dashboard/admin/user')->with('message', 'User updated successfully.');
    }

    public function destroy(int $user_id)
    {
        $user = User::findOrFail($user_id)->update([
            'status_user'   => 0
        ]);
        
        MasterPegawaiTemp::where('nama_pegawai', $user->nama_pegawai)->update([
            'status_user'   => 0
        ]);
        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully.');
    }
}
