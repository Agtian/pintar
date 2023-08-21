<div>
    <div class="card card-outline card-dark">
        <div class="card-header">
            <h3 class="card-title">Tabel Calon Peserta Diklat</h3>
        </div>
        <div class="card-body p-0">
            
            @if(session()->has('success'))
                <div class="p-2">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="p-2">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('error') }}
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-dark">
                            <th width="40">NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>NO HP</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resultDataPeserta as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td width="80" align="center">
                                    <button wire:click.prevent="deletePeserta({{ $item->id }})" class="btn btn-sm btn-danger btn-block">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td align="center" colspan="4">Data tidak tersedia !</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <form>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model.defer="nama" placeholder="Masukan nama lengkap">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="email" placeholder="Masukan email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" wire:model.defer="no_hp" placeholder="0857900882">
                                    @error('no_hp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td><button wire:click.prevent="storePeserta()" type="submit" class="btn btn-md btn-primary btn-block">Simpan</button></td>
                            </tr>
                        </form>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
