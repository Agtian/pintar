<?php

namespace App\Http\Livewire\Diklat\DaftarPeserta;

use App\Models\MasterJenisPraktikanDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPesertaDiklat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableListPesertaDiklat extends Component
{
    protected $paginationTheme = 'bootstrap';

    public $pendaftaran_diklat_id, $surat_diklat_id, $jenis_praktikan_id, $nama, $alamat, $email, $no_hp, $nama_sekolah, $jurusan, $jabatan;

    use WithPagination;

    private function resetInput()
    {
        $this->pendaftaran_diklat_id = null;
        $this->surat_diklat_id = null;
        $this->jenis_praktikan_id = null;
        $this->nama = null;
        $this->alamat = null;
        $this->email = null;
        $this->no_hp = null;
        $this->nama_sekolah = null;
        $this->jurusan = null;
        $this->jabatan = null;
    }

    public function render()
    {
        $resultPesertaDiklat = TransPesertaDiklat::where('pendaftaran_diklat_id', base64_decode($this->pendaftaran_diklat_id))->paginate(10);
        
        $resultJenisPraktikan = MasterJenisPraktikanDiklat::all();
        return view('livewire.diklat.daftar-peserta.table-list-peserta-diklat', compact('resultPesertaDiklat', 'resultJenisPraktikan'));
    }

    public function store()
    {
        $this->validate([
            'pendaftaran_diklat_id' => 'required',
            'jenis_praktikan_id'    => 'required|integer',
            'nama'                  => 'required|string',
            'alamat'                => 'required|string',
            'email'                 => 'required|string|email|max:255|unique:t_peserta_diklat',
            'no_hp'                 => 'required',
            'nama_sekolah'          => 'required|string',
            'jurusan'               => 'required|string',
            'jabatan'               => 'required|string',
        ]);

        $getDataPendaftaran = TransPendaftaranDiklat::findOrFail(base64_decode($this->pendaftaran_diklat_id));

        TransPesertaDiklat::create([
            'user_id'               => Auth::user()->id,
            'pendaftaran_diklat_id' => base64_decode($this->pendaftaran_diklat_id),
            'surat_diklat_id'       => $getDataPendaftaran->surat_diklat_id,
            'jenis_praktikan_id'    => $this->jenis_praktikan_id,
            'nama'                  => $this->nama,
            'alamat'                => $this->alamat,
            'email'                 => $this->email,
            'no_hp'                 => $this->no_hp,
            'nama_sekolah'          => $this->nama_sekolah,
            'jurusan'               => $this->jurusan,
            'jabatan'               => $this->jabatan,
        ]);

        session()->flash('message-livewire', 'Data Berhasil Disimpan.');
        $this->resetInput();
    }
}
