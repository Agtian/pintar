@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Tambah Tarif Pelatihan Pre Klinik</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboad/admin/master-tarif-pelatihan-pre-klinik') }}">Data Tarif Pelatihan Pre Klinik</a></li>
                        <li class="breadcrumb-item active">Form Tarif Pelatihan Pre Klinik</li>
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
                <h3 class="card-title">Form Tambah Tarif Pelatihan Pre Klinik</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/master-tarif-pelatihan-pre-klinik') }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="no_perdir" class="col-sm-3 col-form-label">No SK Perdir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('no_perdir') is-invalid @enderror"
                                id="no_perdir" name="no_perdir" placeholder="Nomor SK Peraturan Direktur"
                                value="{{ old('no_perdir') }}">
                            @error('no_perdir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jasa_sarana" class="col-sm-3 col-form-label">Jasa Sarana</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jasa_sarana') is-invalid @enderror"
                                id="jasa_sarana" name="jasa_sarana" placeholder="Jasa sarana"
                                value="{{ old('jasa_sarana') }}">
                            @error('jasa_sarana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jasa_pelayanan" class="col-sm-3 col-form-label">Jasa Pelayanan</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jasa_pelayanan') is-invalid @enderror"
                                id="jasa_pelayanan" name="jasa_pelayanan" placeholder="Jasa pelayanan"
                                value="{{ old('jasa_pelayanan') }}">
                            @error('jasa_pelayanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_tarif" class="col-sm-3 col-form-label">Jumlah Tarif</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jumlah_tarif') is-invalid @enderror"
                                id="jumlah_tarif" name="jumlah_tarif" placeholder="Jasa pelayanan"
                                value="{{ old('jumlah_tarif') }}">
                            @error('jumlah_tarif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tarif" class="col-sm-3 col-form-label">Status Tarif</label>
                        <div class="col-sm-9">
                            <select name="status_tarif" id="status_tarif" class="form-control @error('status_tarif') is-invalid @enderror">
                                <option value="">-- Pilih status tarif --</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                            @error('status_tarif')
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
