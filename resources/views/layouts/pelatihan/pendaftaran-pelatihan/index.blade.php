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
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Primary</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid pad" src="{{ asset('assets/dist/img/photo2.png') }}" alt="Photo">
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-outline-primary float-right">Pilih Pelatihan</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('script')

@endpush
