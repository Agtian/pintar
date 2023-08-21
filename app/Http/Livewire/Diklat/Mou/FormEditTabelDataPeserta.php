<?php

namespace App\Http\Livewire\Diklat\Mou;

use App\Models\TransPesertaDiklat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormEditTabelDataPeserta extends Component
{
    public $pendaftaran_diklat_id, $nama, $email, $no_hp;

    protected $rules = [
        'nama'  => 'required',
        'email' => 'required|email|max:150|unique:t_peserta_diklat',
        'no_hp' => 'required',
    ];

    public function resetFields(){
        $this->nama     = NULL;
        $this->email    = NULL;
        $this->no_hp    = NULL;
    }

    public function render()
    {
        return view('livewire.diklat.mou.form-edit-tabel-data-peserta', with([
            'resultDataPeserta' => TransPesertaDiklat::where('pendaftaran_diklat_id', base64_decode($this->pendaftaran_diklat_id))->get(),
        ]));
    }

    public function storePeserta()
    {
        $this->validate();

        try {
            TransPesertaDiklat::create([
                'user_id'               => Auth::user()->id,
                'pendaftaran_diklat_id' => base64_decode($this->pendaftaran_diklat_id),
                'nama'                  => $this->nama,
                'email'                 => $this->email,
                'no_hp'                 => $this->no_hp,
            ]);
            session()->flash('success','Data peserta diklat berhasil disimpan.');
            $this->resetFields();
        } catch (\Exception $ex) {
            session()->flash('error', $ex.' Something goes wrong!!');
        }
    }

    public function deletePeserta($id)
    {
        try{
            TransPesertaDiklat::find($id)->delete();
            session()->flash('success',"Data peserta diklat berhasil dihapus");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
