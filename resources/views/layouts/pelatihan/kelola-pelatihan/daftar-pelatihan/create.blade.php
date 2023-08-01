@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Tambah Acara Pelatihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Pelatihan</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboad/admin/daftar-pelatihan') }}">Daftar Pelatihan</a></li>
                        <li class="breadcrumb-item active">Form Tambah Acara Pelatihan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @if (session('success'))
            <h5 class="alert alert-success mb-2">{{ session('success') }}</h5>
        @endif

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Form Tambah Acara Pelatihan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/daftar-pelatihan') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="nama_pelatihan" class="col-sm-3 col-form-label">Nama Pelatihan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                id="nama_pelatihan" name="nama_pelatihan" placeholder="Nama pelatihan"
                                value="{{ old('nama_pelatihan') }}">
                            @error('nama_pelatihan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                            @error('tgl_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                            @error('tgl_selesai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="biaya_per_orang" class="col-sm-3 col-form-label">Biaya Per Orang</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('biaya_per_orang') is-invalid @enderror"
                                id="r" name="biaya_per_orang" placeholder="Biaya per orang"
                                value="{{ old('biaya_per_orang') }}">
                            @error('biaya_per_orang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_max_peserta" class="col-sm-3 col-form-label">Jumlah maksimal peserta</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('role_max_peserta') is-invalid @enderror"
                                id="role_max_peserta" name="role_max_peserta" placeholder="Maksimal peserta"
                                value="{{ old('role_max_peserta') }}">
                            @error('role_max_peserta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="browsur" class="col-sm-3 col-form-label">Unggah Browsur</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control  @error('browsur') is-invalid @enderror" id="browsur" name="browsur">
                            @error('browsur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-sm-9">
                            <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control  @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                            @error('browsur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-outline-primary float-right">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark float-right mr-2">Kembali</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
<!-- bs-custom-file-input -->
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endpush