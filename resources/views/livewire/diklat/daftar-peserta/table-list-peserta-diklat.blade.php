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
    @endif

    <div class="card card-outline card-dark">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                    Tambah Peserta
                </button>
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
                                <span data-toggle="tooltip" data-placement="bottom" title="Edit peserta">
                                    <button type="button" wire:click.prevent="editPeserta({{ $item->id }})"
                                        class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-edit"><i
                                            class="fas fa-edit"></i></button>
                                </span>
                                <button type="button" wire:click.prevent="deletePeserta({{ $item->id }})"
                                    class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="bottom"
                                    title="Hapus peserta"><i class="far fa-trash-alt"></i></button>
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
