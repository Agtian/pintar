<?php

namespace App\Http\Livewire\Diklat\Mou;

use App\Models\TransPesertaDiklat;
use Livewire\Component;

class ModalTampilkanPeserta extends Component
{
    public $pendaftaran_diklat_id, $resultPesertaDiklat = [];

    public function render()
    {
        return view('livewire.diklat.mou.modal-tampilkan-peserta');
    }

    public function getDataPesertaDiklat()
    {
        $this->resultPesertaDiklat = TransPesertaDiklat::where('pendaftaran_diklat_id', $this->pendaftaran_diklat_id)->get();
    }   
}
