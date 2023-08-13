<div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIP/NRP</th>
                        <th>EMAIL</th>
                        <th>NO HP</th>
                        <th>JABATAN</th>
                        <th>UNIT KERJA</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    @forelse ($resultPegawai as $item)
                        <tr>
                            <td width="50" align="center">
                                {{ $loop->iteration + $resultPegawai->firstItem() - 1 }}</td>
                            <td>
                                {{ $item->gelardepan . ' ' . $item->nama_pegawai . ' ' . optional($item->gelarbelakangs)->gelarbelakang_nama }}
                            </td>
                            <td>{{ $item->nomorindukpegawai }}</td>
                            <td>{{ $item->alamatemail }}</td>
                            <td>{{ $item->nomobile_pegawai }}</td>
                            <td>{{ optional($item->jabatans)->jabatan_nama }}</td>
                            <td>{{ optional($item->unitkerjas)->namaunitkerja }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" align="center">Data tidak tersedia !</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <td colspan="8" style="text-align: center;">
                        <div wire:loading>
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <b>Processing loading data...</b>
                        </div>
                    </td>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $resultPegawai->links() }}
    </div>
</div>
