<div>
    <h5>Peserta Diklat</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-secondary">
                    <th width="50">NO</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>NO HP</th>
                    <th>EMAIL</th>
                    <th>INSTANSI</th>
                    <th>JURUSAN</th>
                    <th>JABATAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultPesertaDiklat as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $list->nama }}</td>
                        <td>{{ $list->alamat }}</td>
                        <td>{{ $list->no_hp }}</td>
                        <td>{{ $list->email }}</td>
                        <td>{{ $list->nama_sekolah }}</td>
                        <td>{{ $list->jurusan }}</td>
                        <td>{{ $list->jabatan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" align="center">Data tidak tersedia ! <br>Silahkan input peserta dahulu <a
                                href="{{ url('') }}">klik disini.</a></td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
