@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Rekap Pendapatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Billing Diklat</a></li>
                        <li class="breadcrumb-item active">Data Rekap Pendapatan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @if (session('message'))
            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
        @endif

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Rekap Pendapatan</h3>

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>NAMA</th>
                                        <th>RINCIAN BIAYA</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($resultRekapPendapatan as $item)
                                        <tr>
                                            <td width="50" rowspan="2" align="center">
                                                {{ $loop->iteration + $resultRekapPendapatan->firstItem() - 1 }}
                                            </td>
                                            <td rowspan="2">{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
                                            <td rowspan="2">{{ optional($item->suratDiklat)->nama_instansi }}</td>
                                            <td>
                                                {{ $item->tarifDiklat->get_jenis_kegiatan }}
                                            </td>
                                            <td rowspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Data tidak tersedia !</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                ...
            </div>
        </div>
    </section>
@endsection
