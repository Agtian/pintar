<div>
    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-peserta-diklat" wire:click="getDataPesertaDiklat">Tampilkan Peserta
        Diklat Pendidik Klinis</button><br>

    <div wire:ignore.self class="modal fade" id="modal-peserta-diklat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Table Peserta Diklat & Pendidik Klinis</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>NO HP</th>
                                    <th>ALAMAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($resultPesertaDiklat as $item)
                                    <tr>
                                        <td width="10">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->alamat }}</td>
                                    </tr>
                                @empty
                                    <tr><td align="center" colspan="5">Data tidak tersedia !</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
