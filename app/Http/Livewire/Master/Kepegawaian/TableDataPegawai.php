<?php

namespace App\Http\Livewire\Master\Kepegawaian;

use App\Models\PGSQL\MasterPegawai;
use Livewire\Component;
use Livewire\WithPagination;

class TableDataPegawai extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.master.kepegawaian.table-data-pegawai', with([
            'resultPegawai' => MasterPegawai::paginate(10),
        ]));
    }
}
