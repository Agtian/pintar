<?php

namespace App\Http\Livewire\Diklat\Pendaftaran;

use Livewire\Component;

class AdminMetodePembayaranMou extends Component
{
    public $total_biaya_diklat;

    public function render()
    {
        return view('livewire.diklat.pendaftaran.admin-metode-pembayaran-mou', with([
            'total_biaya_diklat'    => $this->total_biaya_diklat,
        ]));
    }
}
