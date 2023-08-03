@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pendaftaran Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pendaftaran Pelatihan</a></li>
                        <li class="breadcrumb-item active">Pendaftaran Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="row">
            @forelse ($resultAcaraPelatihan as $item)
                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $item->nama_diklat }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body bg-secondary">
                            <img class="img-fluid pad" src="{{ asset('assets/images/browsur').'/'.$item->browsur }}" alt="{{ $item->nama_diklat }}" width="100%">
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('dashboard/admin/pendaftaran-pelatihan/registrasi/'.base64_encode($item->id)).'/reg' }}" class="btn btn-outline-primary float-right">Pilih Pelatihan</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 mt-5">
                    <div class="error-page">
                        <h2 class="headline text-warning"> <i class="nav-icon fas fa-database"></i></h2>
                
                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Pelatihan tidak tersedia.</h3>
                            <p>
                                Sistem tidak menemukan jadwal pelatihan pada master database. Silahkan
                            anda membuat jadwal acara pelatihan dahulu, klik <a href="{{ url('dashboard/admin/daftar-pelatihan') }}">disini</a> untuk membuat jadwal acara pelatihan atau pergi ke menu Daftar Pelatihan.
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
            
        </div>

    </section>
@endsection

@push('script')

@endpush
