@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Ubah Tarif Diklat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboad/admin/master-tarif-diklat') }}">Data Tarif
                                Diklat</a></li>
                        <li class="breadcrumb-item active">Form Ubah Tarif Diklat</li>
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
                <h3 class="card-title">Form Ubah Tarif Diklat</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/master-tarif-diklat/' . base64_encode($detail->id)) }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="jenis_kegiatan_id" class="col-sm-3 col-form-label">Jenis Kegiatan</label>
                        <div class="col-sm-9">
                            <select name="jenis_kegiatan_id" id="jenis_kegiatan_id"
                                class="form-control  @error('jenis_kegiatan_id') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kegiatan -- </option>
                                @foreach ($resultJenisKegiatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $detail->jenis_kegiatan_id ? 'selected' : '' }}>
                                        {{ $item->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                            @error('jenis_kegiatan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan_kegiatan_id" class="col-sm-3 col-form-label">Satuan Kegiatan</label>
                        <div class="col-sm-9">
                            <select name="satuan_kegiatan_id" id="satuan_kegiatan_id"
                                class="form-control  @error('satuan_kegiatan_id') is-invalid @enderror">
                                <option value="">-- Pilih Satuan Kegiatan -- </option>
                                @foreach ($resultSatuanKegiatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $detail->satuan_kegiatan_id ? 'selected' : '' }}>
                                        {{ $item->satuan_kegiatan }}</option>
                                @endforeach
                            </select>
                            @error('satuan_kegiatan_id')
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
                                class="form-control  @error('jenis_praktikan_id') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Praktikan -- </option>
                                @foreach ($resultJenisPraktikan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $detail->jenis_praktikan_id ? 'selected' : '' }}>
                                        {{ $item->jenis_praktikan }}</option>
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
                        <label for="jasa_sarana" class="col-sm-3 col-form-label">Jasa Sarana</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jasa_sarana') is-invalid @enderror"
                                id="jasa_sarana" name="jasa_sarana" placeholder="Jasa Sarana"
                                value="{{ $detail->jasa_sarana }}">
                            @error('jasa_sarana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jasa_lainnya" class="col-sm-3 col-form-label">Jasa Lainnya</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jasa_lainnya') is-invalid @enderror"
                                id="jasa_lainnya" name="jasa_lainnya" placeholder="Jasa Lainnya"
                                value="{{ $detail->jasa_lainnya }}">
                            @error('jasa_lainnya')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                name="jumlah" placeholder="Jumlah" value="{{ $detail->jumlah }}">
                            @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tarif" class="col-sm-3 col-form-label">Status Tarif</label>
                        <div class="col-sm-9">
                            <select name="status_tarif" id="status_tarif"
                                class="form-control  @error('status_tarif') is-invalid @enderror">
                                <option value="">-- Pilih Status Tarif --</option>
                                <option value="1" {{ $detail->status_tarif == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $detail->status_tarif == 2 ? 'selected' : '' }}>Tidak Aktif
                                </option>
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
