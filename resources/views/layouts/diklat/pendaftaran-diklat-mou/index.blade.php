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
            <form action="{{ url('dashboard/admin/pendaftaran') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-panduan-tab" data-toggle="pill" href="#vert-tabs-panduan" role="tab" aria-controls="vert-tabs-panduan" aria-selected="true">Panduan</a>
                                <a class="nav-link" id="vert-tabs-daftar-mou-tab" data-toggle="pill" href="#vert-tabs-daftar-mou" role="tab" aria-controls="vert-tabs-daftar-mou" aria-selected="true">Daftar Peserta MOU</a>
                                <a class="nav-link" id="vert-tabs-unggah-tab" data-toggle="pill" href="#vert-tabs-unggah" role="tab" aria-controls="vert-tabs-unggah" aria-selected="false">Unggah Surat Permohonan Diklat</a>
                                <a class="nav-link" id="vert-tabs-rincian-tab" data-toggle="pill" href="#vert-tabs-rincian" role="tab" aria-controls="vert-tabs-rincian" aria-selected="false">Form Rincian Diklat</a>
                                <a class="nav-link" id="vert-tabs-peserta-tab" data-toggle="pill" href="#vert-tabs-peserta" role="tab" aria-controls="vert-tabs-peserta" aria-selected="false">Form Peserta Diklat</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-panduan" role="tabpanel" aria-labelledby="vert-tabs-panduan-tab">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-daftar-mou" role="tabpanel" aria-labelledby="vert-tabs-daftar-mou-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th width="50"></th>
                                                    <th width="50">NO</th>
                                                    <th>INSTANSI</th>
                                                    <th>BIDANG KERJA SAMA</th>
                                                    <th>TANGGAL MOU</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($resultDaftarMOU as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-radio">
                                                                <input class="custom-control-input" type="radio" id="customRadio{{ base64_encode($item->id) }}" name="customRadioPilih" value="{{ $item->id }}">
                                                                <label for="customRadio{{ $item->id }}" class="custom-control-label">Pilih</label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $loop->iteration + $resultDaftarMOU->firstItem() - 1 }}</td>
                                                        <td>{{ $item->nama_instansi}}</td>
                                                        <td>{{ $item->bidang_kerjasama}}</td>
                                                        <td>{{ $item->tgl_mulai_mou . ' s.d ' . $item->tgl_akhir_mou }}</td>
                                                        <td>
                                                            @if ($item->status_mou == 1)
                                                                <button class="btn btn-xs btn-success">Aktif</button>
                                                            @else
                                                                <button class="btn btn-xs btn-danger">Tidak Aktif</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="6" align="center">Daftar MOU tidak tersedia !</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div>
                                            {{ $resultDaftarMOU->links() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-unggah" role="tabpanel" aria-labelledby="vert-tabs-unggah-tab">
                                    Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-rincian" role="tabpanel" aria-labelledby="vert-tabs-rincian-tab">
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
                                                <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Diklat</label>
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
                                                        id="tgl_akhir" name="tgl_akhir" alue="{{ old('tgl_akhir') }}">
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
                                        </div>
                                    </div>
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
                                <div class="tab-pane fade" id="vert-tabs-peserta" role="tabpanel" aria-labelledby="vert-tabs-peserta-tab">
                                    <div class="col-12">
                                        <div class="card card-outline card-secondary">
                                            <div class="card-header">
                                                <div class="card-title">Form Peserta Diklat</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                            <div class="ribbon-wrapper ribbon-xl">
                                                                <div class="ribbon bg-warning text-md">INFORMASI</div>
                                                            </div>
                                                            <h4>PANDUAN PENGISIAN FORM</h4>
                                                            <ul>
                                                                <li>Isi kolom jumlah peserta dengan variabel angka.</li>
                                                                <li>Tombol <button class="btn btn-xs btn-info">Tampilkan Form Biodata</button> : untuk menampilkan form isian biodata calon peserta.</li>
                                                                <li>Tombol <button class="btn btn-xs btn-primary">Tambah Form</button> : Untuk menambah form isian biodata calon peserta jika peserta lebih dari satu.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-12 mt-5">
                                                        <div class="form-group row">
                                                            <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                                                        id="jumlah_peserta" name="jumlah_peserta" placeholder="Jumlah peserta"
                                                                        value="">
                                                                    <span class="input-group-append">
                                                                        <button type="button" class="btn btn-info" id="tampilkanForm">Tampilkan Form Biodata</button>
                                                                        <button type="button" class="btn btn-primary" id="btn-tambah">Tambah Form</button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Ajukan Permohonan Diklat</button>
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

    <script>
        $('#tampilkanForm').on('click', function() {
            addFormBiodata(3);
        });

        $('#btn-tambah').on('click', function() {
            addFormBiodata(3);
        });

        var count = 0;
        if(count == 0){
            $('.btnSelanjutnya').hide();
        }

        function addFormBiodata() {
            count +=1;
            var form = `<div>
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <div class="card-title">Peserta `+count+`</div>
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

            if(count > 0){
                $('.btnSelanjutnya').show();
            }

            $('.removeItem').on('click', function() {
                $(this).parent().parent().parent().parent().remove();
                count -=1;
                if(count == 0){
                    $('.btnSelanjutnya').hide();
                    location.reload()
                }
            });
        };
        
    </script>
@endpush
