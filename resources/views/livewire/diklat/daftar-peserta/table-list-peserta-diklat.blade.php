<div>
    <div class="card card-outline card-dark" wire:ignore.self>
        <div class="card-header">
            <h3 class="card-title">Form Peserta Diklat</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" wire:model.defer="nama" placeholder="Nama lengkap"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_praktikan_id" class="col-sm-3 col-form-label">Jenis Praktikan</label>
                    <div class="col-sm-9">
                        <select name="jenis_praktikan_id" id="jenis_praktikan_id"
                            class="form-control @error('jenis_praktikan_id') is-invalid @enderror"
                            wire:model.defer="jenis_praktikan_id">
                            <option value="">-- Pilih jenis praktikan --</option>
                            @foreach ($resultJenisPraktikan as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis_praktikan }}</option>
                            @endforeach
                        </select>
                        @error('jenis_praktikan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                            rows="3" wire:model.defer="alamat" placeholder="Alamat lengkap"></textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" wire:model.defer="email" placeholder="peserta.diklat@rsudrehatta.co.id"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No Handphone</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" wire:model.defer="no_hp" placeholder="085722229999"
                            value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_sekolah" class="col-sm-3 col-form-label">Instansi / Sekolah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                            id="nama_sekolah" name="nama_sekolah" wire:model.defer="nama_sekolah"
                            placeholder="Isi nama instansi atau nama sekolah anda" value="{{ old('nama_sekolah') }}">
                        @error('nama_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                            name="jurusan" wire:model.defer="jurusan" placeholder="Keperawatan / Farmasi"
                            value="{{ old('jurusan') }}">
                        @error('jurusan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                            id="jabatan" name="jabatan" wire:model.defer="jabatan"
                            placeholder="Isi dengan nama jabatan anda, jika anda sebagai pelajar/mahasiswa maka isi dengan pelajar/mahasiswa"
                            value="{{ old('jabatan') }}">
                        @error('jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-md btn-primary float-right" wire:click.prevent="store()">Tambah
                    Peserta</button>
            </div>
        </form>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-dark">
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
                            <td>{{ $loop->iteration + $resultPesertaDiklat->firstItem() - 1 }}</td>
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
                            <td colspan="8" align="center">Data tidak tersedia !</td>
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
