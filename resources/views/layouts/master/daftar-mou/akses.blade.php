@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Akses Sistem</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboad/admin/master-daftar-mou') }}">Data Daftar
                                MOU</a></li>
                        <li class="breadcrumb-item active">Form Akses Sistem</li>
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
                <h3 class="card-title">Form Edit Daftar MOU</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/master-daftar-mou/' . base64_encode($detail->id)) }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="no_surat" class="col-sm-3 col-form-label">No Surat MOU</label>
                        <div class="col-sm-9">
                            <input readonly type="text" class="form-control @error('no_surat') is-invalid @enderror"
                                id="no_surat" name="no_surat" placeholder="No Surat MOU" value="{{ $detail->no_surat }}">
                            @error('no_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_mou" class="col-sm-3 col-form-label">Tanggal Surat MOU</label>
                        <div class="col-sm-9">
                            <input readonly type="date" class="form-control @error('tgl_mou') is-invalid @enderror"
                                id="tgl_mou" name="tgl_mou" value="{{ $detail->tgl_mou }}">
                            @error('tgl_mou')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bidang_kerjasama" class="col-sm-3 col-form-label">Bidang Kerjasama</label>
                        <div class="col-sm-9">
                            <input readonly type="text"
                                class="form-control @error('bidang_kerjasama') is-invalid @enderror" id="bidang_kerjasama"
                                name="bidang_kerjasama" placeholder="Bidang Kerjasama"
                                value="{{ $detail->bidang_kerjasama }}">
                            @error('bidang_kerjasama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi</label>
                        <div class="col-sm-9">
                            <input readonly type="text" class="form-control @error('nama_instansi') is-invalid @enderror"
                                id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi"
                                value="{{ $detail->nama_instansi }}">
                            @error('nama_instansi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kota_instansi" class="col-sm-3 col-form-label">Kota Instansi</label>
                        <div class="col-sm-9">
                            <input readonly type="text" class="form-control @error('kota_instansi') is-invalid @enderror"
                                id="kota_instansi" name="kota_instansi" placeholder="Semarang"
                                value="{{ $detail->kota_instansi }}">
                            @error('kota_instansi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jangka_waktu_tahun" class="col-sm-3 col-form-label">Jangka Waktu MOU (tahun)</label>
                        <div class="col-sm-3">
                            <input readonly type="number"
                                class="form-control @error('jangka_waktu_tahun') is-invalid @enderror"
                                id="jangka_waktu_tahun" name="jangka_waktu_tahun" placeholder="Jangka Waktu MOU (tahun)"
                                value="{{ $detail->jangka_waktu_tahun }}">
                            @error('jangka_waktu_tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="tgl_akhir_mou" class="col-form-label">Tahun</label>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_mulai_mou" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-3">
                            <input readonly type="date"
                                class="form-control @error('tgl_mulai_mou') is-invalid @enderror" id="tgl_mulai_mou"
                                name="tgl_mulai_mou" value="{{ $detail->tgl_mulai_mou }}">
                            @error('tgl_mulai_mou')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="tgl_akhir_mou" class="col-form-label">s.d</label>
                        <div class="col-sm-3">
                            <input readonly type="date"
                                class="form-control @error('tgl_akhir_mou') is-invalid @enderror" id="tgl_akhir_mou"
                                name="tgl_akhir_mou" value="{{ $detail->tgl_akhir_mou }}">
                            @error('tgl_akhir_mou')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_mou" class="col-sm-3 col-form-label">Status MOU</label>
                        <div class="col-sm-9">
                            <input readonly class="form-control" id="status_mou" type="text"
                                value="@if ($detail->status_mou == 1) Aktif @elseif($detail->status_mou == 2) Tidak aktif @endif">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="kode_registrasi_akses" class="col-sm-3 col-form-label">Kode Registrasi Akses</label>
                        <div class="col-sm-9">
                            <input readonly type="text"
                                class="form-control @error('kode_registrasi_akses') is-invalid @enderror"
                                id="kode_registrasi_akses" name="kode_registrasi_akses"
                                value="{{ $detail->kode_registrasi_akses }}">
                            @error('kode_registrasi_akses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_akses" class="col-sm-3 col-form-label">Status Akses Sistem</label>
                        <div class="col-sm-9">
                            <select name="status_akses" id="status_akses"
                                class="form-control @error('status_akses') is-invalid @enderror">
                                <option value="">-- Pilih status akses sistem --</option>
                                <option value="1"{{ $detail->status_akses == 1 ? 'selected' : '' }}>Connected
                                </option>
                                <option value="2" {{ $detail->status_akses == 2 ? 'selected' : '' }}>Disconnect
                                </option>
                            </select>
                            @error('status_akses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input readonly type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ $detail->email }}">
                            @error('email')
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
