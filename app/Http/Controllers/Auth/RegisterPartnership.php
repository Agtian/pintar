<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MasterDaftarMOUDiklat;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterPartnership extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:m_daftar_mou_diklat', 'unique:users'],
            'kode_registrasi_akses' => ['required', 'string', 'max:255'],
        ]);

        $cek = MasterDaftarMOUDiklat::where('status_kode_registrasi', 2)
                    ->where('kode_registrasi_akses', $validatedData['kode_registrasi_akses'])
                    ->first();
        if ($cek == null) {
            return redirect('/register')->with(['warning' => 'Email dan kode registrasi tidak sesuai']);
        } else {
            MasterDaftarMOUDiklat::findOrFail($cek->id)->update([
                'email'                 => $validatedData['email'],
                'status_kode_registrasi'=> 1
            ]);
            return redirect('/register-user'.'/'.$validatedData['kode_registrasi_akses'].'/confirm');
        }
    }

    public function index($kode)
    {
        $cek = MasterDaftarMOUDiklat::where('status_kode_registrasi', 1)
                    ->where('kode_registrasi_akses', $kode)
                    ->first();
        return view('auth.register-user', with([
            'email' => $cek->email,
            'daftar_mou_diklat_id' => base64_encode($cek->id),
        ]));
    }

    public function confirmationRegister(Request $request)
    {
        $validatedData = $request->validate([
            'email'                 => ['required', 'string', 'email', 'max:255'],
            'name'                  => ['required', 'string', 'max:255'],
            'number_handphone'      => ['required', 'string', 'max:16'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'daftar_mou_diklat_id' => base64_decode($request->daftar_mou_diklat_id),
            'email'         => $validatedData['email'],
            'name'          => $validatedData['name'],
            'no_hp'         => $validatedData['number_handphone'],
            'password'      => $validatedData['password'],
            'role_as'       => 3,
            'status_user'   => 1,
        ]);

        return redirect('/login')->with(['success' => 'Verifikasi user berhasil, silahkan login.']);
    }
}
