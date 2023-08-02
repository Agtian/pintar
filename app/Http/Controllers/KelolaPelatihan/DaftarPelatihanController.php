<?php

namespace App\Http\Controllers\KelolaPelatihan;

use App\Http\Controllers\Controller;
use App\Models\MasterAcaraDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DaftarPelatihanController extends Controller
{

    public function replaceAll($text) { 
        $text = strtolower(htmlentities($text)); 
        $text = str_replace(get_html_translation_table(), "-", $text);
        $text = str_replace(" ", "_", $text);
        $text = preg_replace("/[-]+/i", "_", $text);
        return $text;
    }

    public function index()
    {
        $resultDaftarPelatihan = MasterAcaraDiklat::paginate(10);
        return view('layouts.pelatihan.kelola-pelatihan.daftar-pelatihan.index', compact('resultDaftarPelatihan'));
    }

    public function create()
    {
        return view('layouts.pelatihan.kelola-pelatihan.daftar-pelatihan.create');
    }

    public function edit($id)
    {
        $detail = MasterAcaraDiklat::findOrFail(base64_decode($id));
        return view('layouts.pelatihan.kelola-pelatihan.daftar-pelatihan.edit', compact('detail'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelatihan'    => 'required',
            'tgl_mulai'         => 'required|date',
            'tgl_selesai'       => 'required|date',
            'biaya_per_orang'   => 'required|integer',
            'role_max_peserta'  => 'required|integer',
            'browsur'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'catatan'           => 'nullable',
            'status'            => 'required',
        ]);

        if ($browsur = $request->file('browsur')) {
            $destinationPath = 'assets/images/browsur/';
            $filename = date('YmdHis') . "-" . $this->replaceAll($request->nama_pelatihan) . "." . $browsur->getClientOriginalExtension();
            $browsur->move($destinationPath, $filename);
            $uploadBrowsur = "$filename";
        } else {
            $uploadBrowsur = "";
        }

        MasterAcaraDiklat::create([
            'user_id'           => Auth::user()->id,
            'nama_diklat'       => $validatedData['nama_pelatihan'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_selesai'       => $validatedData['tgl_selesai'],
            'biaya_per_orang'   => $validatedData['biaya_per_orang'],
            'role_max_peserta'  => $validatedData['role_max_peserta'],
            'browsur'           => $uploadBrowsur,
            'catatan'           => $validatedData['catatan'],
            'status'            => $validatedData['status'],
        ]);

        return redirect('dashboard/admin/daftar-pelatihan')->with(['success' => 'Acara pelatihan berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pelatihan'    => 'required',
            'tgl_mulai'         => 'required|date',
            'tgl_selesai'       => 'required|date',
            'biaya_per_orang'   => 'required|integer',
            'role_max_peserta'  => 'required|integer',
            'browsur'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'catatan'           => 'nullable',
            'status'            => 'required'
        ]);

        if ($browsur = $request->file('browsur')) {
            $query =  MasterAcaraDiklat::findOrFail(base64_decode($id));
            $destinationPath = 'assets/images/browsur/';
            if (File::exists($destinationPath.''.$query->browsur))
            {
                File::delete($destinationPath.''.$query->browsur);
            }


            $filename = date('YmdHis') . "-" . $this->replaceAll($request->nama_pelatihan) . "." . $browsur->getClientOriginalExtension();
            $browsur->move($destinationPath, $filename);
            $uploadBrowsur = "$filename";
            MasterAcaraDiklat::findOrFail(base64_decode($id))->update([
                'user_id'           => Auth::user()->id,
                'nama_diklat'       => $validatedData['nama_pelatihan'],
                'tgl_mulai'         => $validatedData['tgl_mulai'],
                'tgl_selesai'       => $validatedData['tgl_selesai'],
                'biaya_per_orang'   => $validatedData['biaya_per_orang'],
                'role_max_peserta'  => $validatedData['role_max_peserta'],
                'browsur'           => $uploadBrowsur,
                'catatan'           => $validatedData['catatan'],
                'status'            => $validatedData['status'],
            ]);
        } else {
            $uploadBrowsur = "";
            MasterAcaraDiklat::findOrFail(base64_decode($id))->update([
                'user_id'           => Auth::user()->id,
                'nama_diklat'       => $validatedData['nama_pelatihan'],
                'tgl_mulai'         => $validatedData['tgl_mulai'],
                'tgl_selesai'       => $validatedData['tgl_selesai'],
                'biaya_per_orang'   => $validatedData['biaya_per_orang'],
                'role_max_peserta'  => $validatedData['role_max_peserta'],
                'catatan'           => $validatedData['catatan'],
                'status'            => $validatedData['status'],
            ]);
        }

        return redirect('dashboard/admin/daftar-pelatihan')->with(['success' => 'Acara pelatihan berhasil disimpan.']);
    }

    public function destroy($id)
    {
        $query =  MasterAcaraDiklat::findOrFail(base64_decode($id));
        $destinationPath = 'assets/images/browsur/';
        if (File::exists($destinationPath.''.$query->browsur))
        {
            File::delete($destinationPath.''.$query->browsur);
        }
        MasterAcaraDiklat::findOrFail(base64_decode($id))->delete();
        return redirect()->back()->with('message', 'Acara pelatihan berhasil dihapus');
    }
}
