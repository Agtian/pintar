@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Pendaftaran Diklat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                        <li class="breadcrumb-item active">Form Pendaftaran Diklat</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Form Pendaftaran Diklat</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/pendaftaran-diklat') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Form Surat Balasan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="no_surat_diklat" class="col-sm-3 col-form-label">No Surat Masuk</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('no_surat_diklat') is-invalid @enderror"
                                                    id="no_surat_diklat" name="no_surat_diklat" placeholder="No Surat Masuk"
                                                    value="{{ old('no_surat_diklat') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('no_surat_diklat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_surat_diklat" class="col-sm-3 col-form-label">Tanggal Surat
                                            Masuk</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="date"
                                                    class="form-control @error('tgl_surat_diklat') is-invalid @enderror"
                                                    id="tgl_surat_diklat" name="tgl_surat_diklat"
                                                    placeholder="Tanggal Surat Masuk" value="{{ old('tgl_surat_diklat') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('tgl_surat_diklat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('perihal') is-invalid @enderror"
                                                    id="perihal" name="perihal" placeholder="Perihal"
                                                    value="{{ old('perihal') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('perihal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="surat_dari" class="col-sm-3 col-form-label">Surat Dari</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('surat_dari') is-invalid @enderror"
                                                    id="surat_dari" name="surat_dari" placeholder="Surat dari"
                                                    value="{{ old('surat_dari') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('surat_dari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi /
                                            Sekolah</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('nama_instansi') is-invalid @enderror"
                                                    id="nama_instansi" name="nama_instansi"
                                                    placeholder="Nama instansi / sekolah / universitas"
                                                    value="{{ old('nama_instansi') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('nama_instansi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kota_instansi" class="col-sm-3 col-form-label">Kota Instansi /
                                            Sekolah</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('kota_instansi') is-invalid @enderror"
                                                    id="kota_instansi" name="kota_instansi"
                                                    placeholder="Kota instansi / sekolah / universitas"
                                                    value="{{ old('kota_instansi') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('kota_instansi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai
                                            Diklat</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="date"
                                                    class="form-control @error('tgl_mulai') is-invalid @enderror"
                                                    id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('tgl_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir
                                            Diklat</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="date"
                                                    class="form-control @error('tgl_akhir') is-invalid @enderror"
                                                    id="tgl_akhir" name="tgl_akhir" value="{{ old('tgl_akhir') }}">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                </div>
                                            </div>
                                            @error('tgl_akhir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Form Rincian Diklat</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="unit_kerja_id" class="col-sm-3 col-form-label">Unit Kerja
                                            Diklat</label>
                                        <div class="col-sm-9">
                                            <select name="unit_kerja_id" id="unit_kerja_id"
                                                class="form-control @error('unit_kerja_id') is-invalid @enderror">
                                                <option value="">-- Pilih Unit Kerja --</option>
                                                @foreach ($resultUnitKerja as $item)
                                                    <option value="{{ $item->id }}">{{ $item->unit_kerja }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit_kerja_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis_kegiatan_id" class="col-sm-3 col-form-label">Jenis
                                            Kegiatan</label>
                                        <div class="col-sm-9">
                                            <select name="jenis_kegiatan_id" id="jenis_kegiatan_id"
                                                class="form-control @error('jenis_kegiatan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Jenis Kegiatan --</option>
                                                @foreach ($resultJenisKegiatan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kegiatan }}
                                                    </option>
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
                                        <label for="satuan_kegiatan_id" class="col-sm-3 col-form-label">Satuan
                                            Kegiatan</label>
                                        <div class="col-sm-9">
                                            <select name="satuan_kegiatan_id" id="satuan_kegiatan_id"
                                                class="form-control @error('satuan_kegiatan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Satuan Kegiatan --</option>
                                            </select>
                                            @error('satuan_kegiatan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="total_waktu" class="col-sm-3 col-form-label">Lama Waktu
                                            Kegiatan</label>
                                        <div class="col-sm-9">
                                            <input type="number"
                                                class="form-control @error('total_waktu') is-invalid @enderror"
                                                id="total_waktu" name="total_waktu" placeholder="Lama Waktu kegiatan"
                                                value="{{ old('total_waktu') }}">
                                            @error('total_waktu')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis_praktikan_id" class="col-sm-3 col-form-label">Jenis
                                            Praktikan</label>
                                        <div class="col-sm-9">
                                            <select name="jenis_praktikan_id" id="jenis_praktikan_id"
                                                class="form-control @error('jenis_praktikan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Jenis
                                                    Praktikan --</option>
                                            </select>
                                            @error('jenis_praktikan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                        <div class="col-sm-9">
                                            <input type="number"
                                                class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                                id="jumlah_peserta" name="jumlah_peserta" placeholder="Jumlah Peserta"
                                                value="{{ old('jumlah_peserta') }}">
                                            @error('jumlah_peserta')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="opsi_honorarium" class="col-sm-3 col-form-label">Biaya Lainnya</label>
                                        <div class="col-sm-9">
                                            <select name="opsi_honorarium" id="opsi_honorarium"
                                                class="form-control @error('opsi_honorarium') is-invalid @enderror">
                                                <option value="">-- Pilih biaya lainnya --</option>
                                                <option value="ya" disabled>Dengan biaya honorarium CI</option>
                                                <option value="tidak" selected>Tidak dengan biaya honorarium CI</option>
                                            </select>
                                            @error('opsi_honorarium')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambahan Peserta Kompetensi Dasar & Kredensial</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="jumlah_peserta_tambahan" class="col-sm-3 col-form-label">Jumlah Peserta Tambahan</label>
                                        <div class="col-sm-3">
                                            <input type="number"
                                                class="form-control @error('jumlah_peserta_tambahan') is-invalid @enderror"
                                                id="jumlah_peserta_tambahan" name="jumlah_peserta_tambahan" placeholder="Jumlah perserta tambahan"
                                                value="{{ old('jumlah_peserta_tambahan') }}">
                                            @error('jumlah_peserta_tambahan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label class="col-sm-3 col-form-label">Orang</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tarif_kopetensi_dasar_kredesial" class="col-sm-3 col-form-label">Tarif Kompetensi Dasar & Kredensial / Orang</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control"
                                                id="tarif_kopetensi_dasar_kredesial @error('tarif_kopetensi_dasar_kredesial') is-invalid @enderror" name="tarif_kopetensi_dasar_kredesial" 
                                                value="Rp. {{ $jumlah_tarif }}" readonly>
                                            @error('jumlah_peserta_tambahan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-outline-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#jenis_kegiatan_id').on('change', function() {
                var jenis_kegiatan_id = this.value;
                $("#satuan_kegiatan_id").html('');
                $.ajax({
                    url: "{{ url('api/fetch-satuan-kegiatan-diklat') }}",
                    type: "POST",
                    data: {
                        jenis_kegiatan_id: jenis_kegiatan_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#satuan_kegiatan_id').html(
                            '<option value="">-- Pilih Satuan Kegiatan --</option>');
                        $.each(result.satuan_kegiatan, function(key, value) {
                            $("#satuan_kegiatan_id").append('<option value="' + value
                                .satuan_kegiatan_id + '">' + value.alias +
                                '</option>');
                        });
                        $('#jenis_praktikan_id').html(
                            '<option value="">-- Pilih Jenis Praktikan --</option>');
                    }
                });
            });

            $('#satuan_kegiatan_id').on('change', function() {
                var satuan_kegiatan_id = this.value;
                $("#jenis_praktikan_id").html('');
                $.ajax({
                    url: "{{ url('api/fetch-jenis-praktikan-diklat') }}",
                    type: "POST",
                    data: {
                        satuan_kegiatan_id: satuan_kegiatan_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#jenis_praktikan_id').html(
                            '<option value="">-- Pilih Jenis Praktikan --</option>');
                        $.each(res.jenis_praktikans, function(key, value) {
                            $("#jenis_praktikan_id").append('<option value="' + value
                                .jenis_praktikan_id + '">' + value.jenis_praktikan +
                                '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
