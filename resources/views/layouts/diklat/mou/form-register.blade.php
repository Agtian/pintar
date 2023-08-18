@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/style-step-progress-bar.css') }}">
@endpush

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pendaftaran Diklat</a></li>
                        <li class="breadcrumb-item active">Form Pendaftaran</li>
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
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-12 text-center p-0">
                        <form id="form" action="{{ url('register-training') }}" method="POST"
                            enctype='multipart/form-data'>
                            @csrf
                            @method('POST')
                            <ul id="progressbar">
                                <li class="active" id="step1">
                                    <strong>Informasi</strong>
                                </li>
                                <li id="step2"><strong>Form Unggah Surat Permohonan Diklat</strong></li>
                                <li id="step3"><strong>Form Rincian Diklat</strong></li>
                                <li id="step4"><strong>Form Biodata Peserta</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <br>
                            <fieldset>
                                <h2>Informasi</h2>
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Informasi</h3>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <br>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus
                                        ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non
                                        magna
                                        feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare
                                        ligula.
                                        Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque
                                        habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                        Proin
                                        id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim
                                        sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin
                                        porttitor
                                        porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non
                                        consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae
                                        lectus.
                                        Cras lacinia erat eget sapien porta consectetur.
                                    </div>
                                </div>
                                <input type="button" name="next-step" class="next-step btn btn-md btn-primary"
                                    value="Selanjutnya" />
                            </fieldset>
                            <fieldset>
                                <h2>Form Unggah Surat Permohonan Diklat</h2>
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Unggah Surat Permohonan Diklat</h3>
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td width="10">-</td>
                                                <td align="left">Ukuran file maksimal 512 KB</td>
                                            </tr>
                                            <tr>
                                                <td width="10">-</td>
                                                <td align="left">Format file PDF</td>
                                            </tr>
                                        </table>
                                        <p>- </p>
                                        <div class="form-group row">
                                            <label for="tgl_surat_diklat" class="col-sm-3 col-form-label">Tanggal
                                                Surat</label>
                                            <div class="col-sm-9">
                                                <input type="date"
                                                    class="form-control @error('tgl_surat_diklat') is-invalid @enderror"
                                                    id="tgl_surat_diklat" name="tgl_surat_diklat"
                                                    value="{{ old('tgl_surat_diklat') }}">
                                                @error('tgl_surat_diklat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_surat_diklat" class="col-sm-3 col-form-label">No
                                                Surat</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control @error('no_surat_diklat') is-invalid @enderror"
                                                    id="no_surat_diklat" name="no_surat_diklat"
                                                    placeholder="Nomor surat permohonan diklat"
                                                    value="{{ old('no_surat_diklat') }}">
                                                @error('no_surat_diklat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="surat_permohonan" class="col-sm-3 col-form-label">Unggah
                                                Dokumen PDF</label>
                                            <div class="col-sm-9">
                                                <input type="file"
                                                    class="form-control @error('surat_permohonan') is-invalid @enderror"
                                                    name="surat_permohonan" id="surat_permohonan">
                                                @error('surat_permohonan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next-step" class="next-step" value="Selanjutnya" />
                                <input type="button" name="previous-step" class="previous-step" value="Kembali" />
                            </fieldset>
                            <fieldset>
                                <h2>Form Rincian Diklat</h2>
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Rincian Diklat</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="callout callout-info">
                                            <h5 align="left">Informasi</h5>
                                            <table>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Isi form rincian diklat ini sesuai dengan
                                                        karakteristik dan kebutuhan
                                                        pengajuan diklat dari institusi pendidikan.</td>
                                                </tr>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Pada kolom <b>Lama Waktu Kegiatan</b> satuan
                                                        nilainya
                                                        ada pada atas kolom ini
                                                        (kolom satuan waktu kegiatan).</td>
                                                </tr>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Pada kolom <b>Tanggal Diklat</b>, diisi dengan
                                                        tanggal mulai
                                                        pelaksanaan kegiatan dan tanggal akhir pelaksaan kegiatan.</td>
                                                </tr>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Pada kolom <b>Jumlah Peserta</b>, diisi dengan
                                                        jumlah peserta siswa
                                                        yang akan mengikuti diklat.</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="form-group row">
                                            <label for="unit_kerja_id" class="col-sm-3 col-form-label">Unit Kerja
                                                Diklat</label>
                                            <div class="col-sm-9">
                                                <select name="unit_kerja_id" id="unit_kerja_id"
                                                    class="form-control @error('unit_kerja_id') is-invalid @enderror">
                                                    <option value="">-- Pilih Unit Kerja --</option>
                                                    @foreach ($resultUnitKerja as $item)
                                                        <option value="{{ $item->id }}">{{ $item->unit_kerja }}
                                                        </option>
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
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_kegiatan }}
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
                                                Waktu Kegiatan</label>
                                            <div class="col-sm-9">
                                                <select name="satuan_kegiatan_id" id="satuan_kegiatan_id"
                                                    class="form-control @error('satuan_kegiatan_id') is-invalid @enderror">
                                                    <option value="">-- Pilih Satuan Waktu Kegiatan --</option>
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
                                            <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal
                                                Diklat</label>
                                            <div class="col-sm-4">
                                                <input type="date"
                                                    class="form-control @error('tgl_awal') is-invalid @enderror"
                                                    id="tgl_awal" name="tgl_awal" value="{{ old('tgl_awal') }}">
                                                @error('tgl_awal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="tgl_akhir" class="col-form-label"> s.d</label>
                                            <div class="col-sm-4">
                                                <input type="date"
                                                    class="form-control @error('tgl_akhir') is-invalid @enderror"
                                                    id="tgl_akhir" name="tgl_akhir" value="{{ old('tgl_akhir') }}">
                                                @error('tgl_akhir')
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
                                            <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah
                                                Peserta</label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                                    id="jumlah_peserta" name="jumlah_peserta"
                                                    placeholder="Jumlah Peserta" value="{{ old('jumlah_peserta') }}">
                                                @error('jumlah_peserta')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Tambahan Peserta Kompetensi Dasar & Kredensial</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="callout callout-info">
                                            <h5 align="left">Informasi</h5>
                                            <table>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Kompetensi Dasar & Kredensial wajib diikuti oleh
                                                        calon siswa diklat
                                                        dan pendidik klinis institusi pendidikan</td>
                                                </tr>
                                                <tr>
                                                    <td width="10">-</td>
                                                    <td align="left">Pada kolom <b>Jumlah Peserta Tambahan</b>, diisi
                                                        dengan jumlah calon
                                                        siswa diklat ditambah dengan jumlah pendidik klinis institusi
                                                        pendidikan.</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jumlah_peserta_tambahan" class="col-sm-3 col-form-label">Jumlah
                                                Peserta Tambahan</label>
                                            <div class="col-sm-3">
                                                <input type="number"
                                                    class="form-control @error('jumlah_peserta_tambahan') is-invalid @enderror"
                                                    id="jumlah_peserta_tambahan" name="jumlah_peserta_tambahan"
                                                    placeholder="Jumlah perserta tambahan"
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
                                            <label for="tarif_kopetensi_dasar_kredesial"
                                                class="col-sm-3 col-form-label">Tarif Kompetensi Dasar & Kredensial /
                                                Orang</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    id="tarif_kopetensi_dasar_kredesial"
                                                    name="tarif_kopetensi_dasar_kredesial"
                                                    value="Rp. {{ $jumlah_tarif }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next-step" class="next-step" value="Selanjutnya" />
                                <input type="button" name="previous-step" class="previous-step" value="Kembali" />
                            </fieldset>
                            <fieldset>
                                <h2>Form Biodata Peserta Diklat</h2>
                                <div class="col-12">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <div class="card-title">Form Biodata Peserta Diklat</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                        <h5 align="left">PANDUAN PENGISIAN FORM</h5>
                                                        <table>
                                                            <tr>
                                                                <td width="10">-</td>
                                                                <td align="left">Pada kolom <b>Jumlah Peserta</b>, diisi
                                                                    total jumlah seluruh calon peserta diklat RSUD dr. Rehatta.</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10">-</td>
                                                                <td align="left">Tombol <a
                                                                        class="btn btn-xs btn-info">Tampilkan
                                                                        Form Biodata</a> : untuk menampilkan form isian
                                                                    biodata calon peserta.</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="10">-</td>
                                                                <td align="left">Tombol <a
                                                                        class="btn btn-xs btn-primary">Tambah
                                                                        Form</a> : Untuk menambah form isian biodata
                                                                    calon peserta jika peserta lebih dari satu.</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-5">
                                                    <div class="form-group row">
                                                        <label for="jumlah_peserta" class="col-sm-3 col-form-label">Total
                                                            Jumlah Peserta</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="number"
                                                                    class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                                                    id="jumlah_peserta" name="jumlah_peserta"
                                                                    placeholder="Total jumlah peserta"
                                                                    value="{{ old('jumlah_peserta') }}">
                                                                <span class="input-group-append">
                                                                    <button type="button" class="btn btn-info"
                                                                        id="tampilkanForm">Tampilkan Form
                                                                        Biodata</button>
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn-tambah">Tambah Form</button>
                                                                </span>
                                                            </div>
                                                            @error('jumlah_peserta')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div id="form-biodata">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-flat float-right mt-2">Ajukan
                                    Permohonan
                                    Diklat</button>
                                <input type="button" name="previous-step" class="previous-step" value="Kembali" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('assets/js/step-progress-bar.js') }}"></script>

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

    <script>
        $('#tampilkanForm').on('click', function() {
            addFormBiodata(3);
        });

        $('#btn-tambah').on('click', function() {
            addFormBiodata(3);
        });

        var count = 0;
        if (count == 0) {
            $('.btnSelanjutnya').hide();
        }

        function addFormBiodata() {
            count += 1;
            var form = `<div>
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <div class="card-title">Peserta ` + count + `</div>
                        <div class="card-tools">
                            <button type="button" class="removeItem btn btn-sm btn-danger"> Hapus Peserta</button>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror" name="nama_peserta[]" placeholder="Nama">
                                </div>
                                @error('nama_peserta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email[]" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp[]" placeholder="085799991111">
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $('#form-biodata').append(form);

            if (count > 0) {
                $('.btnSelanjutnya').show();
            }

            $('.removeItem').on('click', function() {
                $(this).parent().parent().parent().parent().remove();
                count -= 1;
                if (count == 0) {
                    $('.btnSelanjutnya').hide();
                    location.reload()
                }
            });
        };
    </script>
@endpush
