@push('style')
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Pendaftaran Pelatihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Pelatihan</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboad/admin/daftar-pelatihan') }}">Daftar Pelatihan</a></li>
                        <li class="breadcrumb-item active">Form Pendaftaran Pelatihan</li>
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
                <h3 class="card-title">Form Pendaftaran Pelatihan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/daftar-pelatihan') }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group row">
                                <label for="nama_pelatihan" class="col-sm-3 col-form-label">Nama Pelatihan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                        id="nama_pelatihan" name="nama_pelatihan" placeholder="Nama pelatihan"
                                        value="{{ $detail->nama_diklat }}" readonly>
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
                                    <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror"
                                        id="tgl_mulai" name="tgl_mulai" value="{{ $detail->tgl_mulai }}" readonly>
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
                                    <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"
                                        id="tgl_selesai" name="tgl_selesai" value="{{ $detail->tgl_selesai }}" readonly>
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
                                    <input type="text" class="form-control @error('biaya_per_orang') is-invalid @enderror"
                                        id="r" name="biaya_per_orang" placeholder="Biaya per orang"
                                        value="Rp. {{ number_format($detail->biaya_per_orang, 2, '.',',') }}" readonly>
                                    @error('biaya_per_orang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_max_peserta" class="col-sm-3 col-form-label">Maksimal kuota peserta</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('role_max_peserta') is-invalid @enderror"
                                        id="role_max_peserta" name="role_max_peserta" placeholder="Maksimal peserta"
                                        value="{{ $detail->role_max_peserta }} Orang" readonly>
                                    @error('role_max_peserta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_max_peserta" class="col-sm-3 col-form-label">Kuota peserta yang tersedia</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('role_max_peserta') is-invalid @enderror"
                                        id="role_max_peserta" name="role_max_peserta" placeholder="Maksimal peserta"
                                        value="{{ $sisa_kuota_pendaftar }} Orang" readonly>
                                    @error('role_max_peserta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="acara_diklat_id" value="{{ base64_encode($detail->id) }}">
                        </div>
                        <div class="col-3">
                            <div class="filtr-item" data-category="2, 4" data-sort="{{ $detail->nama_diklat }}">
                                <a href="{{ asset('assets/images/browsur').'/'.$detail->browsur }}" data-toggle="lightbox" data-title="{{ $detail->nama_diklat }}">
                                    <div class="timeline-item p-2 bg-dark">
                                        <img src="{{ asset('assets/images/browsur').'/'.$detail->browsur }}" class="img-fluid mb-2" alt="{{ $detail->nama_diklat }}" width="230"/>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 mt-5">
                            <div class="card card-outline card-secondary">
                                <div class="card-header">
                                    <div class="card-title">Data Peserta</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                <div class="ribbon-wrapper ribbon-xl">
                                                    <div class="ribbon bg-warning text-md">INFORMASI</div>
                                                </div>
                                                <h4>CARA PENDAFTARAN</h4>
                                                <ol>
                                                    <li>Coffee</li>
                                                    <li>Tea</li>
                                                    <li>Milk</li>
                                                  </ol>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <div class="form-group row">
                                                <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                                            id="jumlah_peserta" name="jumlah_peserta" placeholder="Jumlah peserta"
                                                            value="{{ $detail->nama_diklat }}">
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
                <div class="card-footer clearfix">
                    <div class="btnSelanjutnya">
                        <button type="submit" class="btn btn-outline-primary float-right">Simpan Pendaftaran</button>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark float-right mr-2">Kembali</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <!-- Ekko Lightbox -->
    <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <!-- Filterizr-->
    <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>

    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        
            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
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