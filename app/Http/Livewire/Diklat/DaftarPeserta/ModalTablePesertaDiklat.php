<?php

namespace App\Http\Livewire\Diklat\DaftarPeserta;

use App\Models\TransPesertaDiklat;
use Livewire\Component;

class ModalTablePesertaDiklat extends Component
{
    public $pendaftaran_diklat_id;

    public function render()
    {
        $resultPesertaDiklat = TransPesertaDiklat::where('pendaftaran_diklat_id', $this->pendaftaran_diklat_id)->get();
        return view('livewire.diklat.daftar-peserta.modal-table-peserta-diklat', compact('resultPesertaDiklat'));
    }
}
