<div>
    @include('livewire.diklat.daftar-peserta.inc.modal-add-peserta')
    @include('livewire.diklat.daftar-peserta.inc.modal-edit-peserta')

    @if (session('message-livewire'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <br> {{ session('message-livewire') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('message-livewire-danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> <br> {{ session('message-livewire-danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-dark">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                    Tambah Peserta
                </button>
            </div>
            <div class="text-muted mt-3">
                <b>* Anda hanya dapat menginput {{ $totalPeserta }} peserta, sesuai dengan permohonan yang diajukan.</b>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-dark">
                        <th width="50"></th>
                        <th width="50">NO</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>EMAIL</th>
                        <th>NO HP</th>
                        <th>INSTANSI</th>
                        <th>JURUSAN</th>
                        <th>JABATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultPesertaDiklat as $item)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <span data-toggle="tooltip" data-placement="bottom" title="Edit peserta">
                                            <a class="dropdown-item" wire:click.prevent="editPeserta({{ $item->id }})" data-toggle="modal" data-target="#modal-edit"><i
                                                class="fas fa-edit"></i> Edit</a>
                                        </span>
                                        <a class="dropdown-item" wire:click.prevent="deletePeserta({{ $item->id }})" data-toggle="tooltip" data-placement="bottom"
                                            title="Hapus peserta"><i class="far fa-trash-alt"></i> Hapus</a>
                                    </div>
                                </div>
                            </td>
                            <td align="center">{{ $loop->iteration + $resultPesertaDiklat->firstItem() - 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->nama_sekolah }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>{{ $item->jabatan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" align="center">Data tidak tersedia !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $resultPesertaDiklat->links() }}
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#modal-add').modal('hide');
            $('#modal-edit').modal('hide');
        });
    </script>
@endpush
