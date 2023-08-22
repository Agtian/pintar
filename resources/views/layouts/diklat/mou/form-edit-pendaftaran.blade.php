@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Edit Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pendaftaran Diklat</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Pendaftaran</a></li>
                        <li class="breadcrumb-item active">Form Edit Pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Pendaftaran</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0">
                        <thead>
                            <tr class="bg-secondary">
                                <th width="50" align="center">NO</th>
                                <th>TGL DAFTAR</th>
                                <th>STATUS</th>
                                <th>TGL KEGIATAN</th>
                                <th>NAMA PESERTA</th>
                                <th>SURAT PERMOHONAN</th>
                                <th width="250">RINCIAN BIAYA</th>
                                <th>JUMLAH BIAYA</th>
                                <th>TOTAL BIAYA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultDataPendaftaran as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tgl_pendaftaran)) }}</td>
                                    <td>
                                        @if ($item->status_pendaftaran == 0)
                                            <button class="btn btn-default btn-sm btn-block">Belum dikirim</button>
                                        @elseif ($item->status_pendaftaran == 1)
                                            <button class="btn btn-danger btn-sm btn-block">Aktif, belum lunas</button>
                                        @elseif ($item->status_pendaftaran == 2)
                                            <button class="btn btn-success btn-sm btn-block">Aktif, sudah lunas</button>
                                        @elseif ($item->status_pendaftaran == 3)
                                            <button class="btn btn-primary btn-sm btn-block">Selesai, sudah lunas</button>
                                        @elseif ($item->status_pendaftaran == 4)
                                            <button class="btn btn-danger btn-sm btn-block">Batal</button>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($item->tgl_mulai)) }} <br> s.d <br>
                                        {{ date('d/m/Y', strtotime($item->tgl_akhir)) }} <br>
                                        ({{ $item->total_waktu . ' ' . $item->alias }})
                                    </td>
                                    <td>
                                        @livewire('diklat.mou.modal-tampilkan-peserta', ['pendaftaran_diklat_id' => $item->pendaftaran_diklat_id ])
                                    </td>
                                    <td>
                                        <a href="{{ url('data-pendaftaran/printout/'.base64_encode($item->pendaftaran_diklat_id).'/view') }}" target="_blank" class="btn btn-sm btn-default">Tampilkan Surat Permohonan</a><br>
                                    </td>
                                    <td>
                                        Biaya {{ $item->nama_kegiatan . ' ' . $item->jenis_praktikan }} (Per
                                        {{ $item->alias }}) Rp. {{ number_format($item->jumlah, 2, ',', '.') }} <b>x</b>
                                        {{ $item->total_waktu . ' ' . $item->alias }} <b>x</b> {{ $item->jumlah_peserta }}
                                        Org
                                        <hr>
                                        Biaya pelatihan kompetensi dasar & kredensial Rp.
                                        {{ number_format($item->tarif_pre_klinik, 2, ',', '.') }} <b>x</b>
                                        {{ $item->jumlah_peserta_tambahan }} Org
                                    </td>
                                    <td>
                                        Rp.
                                        {{ number_format($item->jumlah * $item->total_waktu * $item->jumlah_peserta, 2, ',', '.') }}
                                        <hr>
                                        Rp.
                                        {{ number_format($item->tarif_pre_klinik * $item->jumlah_peserta_tambahan, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        Rp.
                                        {{ number_format($item->jumlah * $item->total_waktu * $item->jumlah_peserta + $item->tarif_pre_klinik * $item->jumlah_peserta_tambahan, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="5">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                
                <form action="{{ url('data-pendaftaran/'.base64_encode($detail->pendaftaran_diklat_id)) }}" method="POST"  enctype='multipart/form-data'>
                    @method('PUT')
                    @csrf
                    <div class="row p-2">
                        <div class="col-md-12">
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
                                    <div class="form-group row">
                                        <label for="tgl_surat_diklat" class="col-sm-3 col-form-label">Tanggal
                                            Surat</label>
                                        <div class="col-sm-9">
                                            <input type="date"
                                                class="form-control @error('tgl_surat_diklat') is-invalid @enderror"
                                                id="tgl_surat_diklat" name="tgl_surat_diklat"
                                                value="{{ $detail->tgl_surat_diklat }}">
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
                                                value="{{ $detail->no_surat_diklat }}">
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
                        </div>
                        <div class="col-md-6">
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
                                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal
                                            Diklat</label>
                                        <div class="col-sm-4">
                                            <input type="date"
                                                class="form-control @error('tgl_mulai') is-invalid @enderror"
                                                id="tgl_mulai" name="tgl_mulai" value="{{ $detail->tgl_mulai }}">
                                            @error('tgl_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="tgl_akhir" class="col-form-label"> s.d</label>
                                        <div class="col-sm-4">
                                            <input type="date"
                                                class="form-control @error('tgl_akhir') is-invalid @enderror"
                                                id="tgl_akhir" name="tgl_akhir" value="{{ $detail->tgl_akhir }}">
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
                                                placeholder="Jumlah Peserta" value="{{ $detail->jumlah_peserta }}">
                                            @error('jumlah_peserta')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                                value="{{ $detail->jumlah_peserta_tambahan }}">
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
                        </div>
                        <div class="col-md-12">
                            @livewire('diklat.mou.form-edit-tabel-data-peserta', ['pendaftaran_diklat_id' => request()->segment(2)])
                        </div>
                        <div class="col-md-12">
                            <div class="card card-outline card-dark">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-md btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
@endpush