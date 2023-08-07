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

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $send_pendaftaran_diklat_id, $peserta_diklat_id, $pendaftaran_diklat_id, $surat_diklat_id, $jenis_praktikan_id, $nama, $alamat, $email, $no_hp, $nama_sekolah, $jurusan, $jabatan;

    use WithPagination;

    public function resetInput()
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

    public function closeModal()
    {
        $this->resetInput();
        $this->emit(event:'refreshComponent');
    }

    public function render()
    {
        $resultPesertaDiklat    = TransPesertaDiklat::where('pendaftaran_diklat_id', base64_decode($this->send_pendaftaran_diklat_id))->paginate(10);
        $resultJenisPraktikan   = MasterJenisPraktikanDiklat::all();
        $getTPendaftaranDiklat  = TransPendaftaranDiklat::findOrFail(base64_decode($this->send_pendaftaran_diklat_id));

        $totalPeserta = $getTPendaftaranDiklat->jumlah_peserta + $getTPendaftaranDiklat->jumlah_perserta_tambahan;

        return view('livewire.diklat.daftar-peserta.table-list-peserta-diklat', compact('resultPesertaDiklat', 'resultJenisPraktikan', 'totalPeserta'));
    }

    public function editPeserta(int $id)
    {
        $detail = TransPesertaDiklat::findOrFail($id);
        $this->peserta_diklat_id    = $detail->id;
        $this->pendaftaran_diklat_id = $detail->pendaftaran_diklat_id;
        $this->surat_diklat_id = $detail->surat_diklat_id;
        $this->jenis_praktikan_id = $detail->jenis_praktikan_id;
        $this->nama = $detail->nama;
        $this->alamat = $detail->alamat;
        $this->email = $detail->email;
        $this->no_hp = $detail->no_hp;
        $this->nama_sekolah = $detail->nama_sekolah;
        $this->jurusan = $detail->jurusan;
        $this->jabatan = $detail->jabatan;
    }

    public function store()
    {
        $this->validate([
            'jenis_praktikan_id'    => 'required|integer',
            'nama'                  => 'required|string',
            'alamat'                => 'required|string',
            'email'                 => 'required|string|email|max:255|unique:t_peserta_diklat',
            'no_hp'                 => 'required',
            'nama_sekolah'          => 'required|string',
            'jurusan'               => 'required|string',
            'jabatan'               => 'required|string',
        ]);

        $getDataPendaftaran = TransPendaftaranDiklat::findOrFail(base64_decode($this->send_pendaftaran_diklat_id));
        $countData = TransPesertaDiklat::where('pendaftaran_diklat_id', base64_decode($this->send_pendaftaran_diklat_id))->get();

        if ($countData->count() == ($getDataPendaftaran->jumlah_peserta + $getDataPendaftaran->jumlah_peserta_tambahan)) {
            session()->flash('message-livewire-danger', 'Peserta yang anda input melebihi batas yang anda ajukan.');
            $this->dispatchBrowserEvent('close-modal');
            $this->emit(event:'refreshComponent');
        } else if ($countData->count() < ($getDataPendaftaran->jumlah_peserta + $getDataPendaftaran->jumlah_peserta_tambahan)) {
            TransPesertaDiklat::create([
                'user_id'               => Auth::user()->id,
                'pendaftaran_diklat_id' => base64_decode($this->send_pendaftaran_diklat_id),
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
    
            session()->flash('message-livewire', 'Data berhasil disimpan.');
            $this->dispatchBrowserEvent('close-modal');
            $this->emit(event:'refreshComponent');
        } else {
            session()->flash('message-livewire-danger', 'Peserta yang anda input melebihi batas yang anda ajukan.');
            $this->dispatchBrowserEvent('close-modal');
            $this->emit(event:'refreshComponent');
        }
    }

    public function updatePeserta()
    {
        $this->validate([
            'pendaftaran_diklat_id' => 'required',
            'jenis_praktikan_id'    => 'required|integer',
            'nama'                  => 'required|string',
            'alamat'                => 'required|string',
            'email'                 => 'required|string|email|max:255',
            'no_hp'                 => 'required',
            'nama_sekolah'          => 'required|string',
            'jurusan'               => 'required|string',
            'jabatan'               => 'required|string',
        ]);

        $getDataPendaftaran = TransPendaftaranDiklat::findOrFail($this->pendaftaran_diklat_id);

        TransPesertaDiklat::findOrFail($this->peserta_diklat_id)->update([
            'user_id'               => Auth::user()->id,
            'pendaftaran_diklat_id' => $this->pendaftaran_diklat_id,
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

        session()->flash('message-livewire', 'Data berhasil diperbarui.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deletePeserta(int $id)
    {
        TransPesertaDiklat::findOrFail($id)->delete();
        session()->flash('message-livewire', 'Data pelaksana berhasil dihapus');
    }
}
