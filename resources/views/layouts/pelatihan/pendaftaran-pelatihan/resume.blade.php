@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Resume</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                        <li class="breadcrumb-item">Form Pendaftaran Pelatihan</li>
                        <li class="breadcrumb-item active">Resume</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Permohonan Pelatihan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-outline card-dark">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Nama Pelatihan</th>
                                            <td>: {{ $detail['nama_diklat'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td><textarea class="form-control" cols="30" rows="10" readonly>{{ $detail['catatan'] }}</textarea></td>
                                        </tr>
                                        <tr>
                                            <th>Kode Pendaftaran</th>
                                            <td>: {{ $detail['kode_pendaftaran'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Daftar</th>
                                            <td>: {{ date('d-m-Y', strtotime($detail['tgl_pendaftaran'])) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pelaksaan Diklat:</th>
                                            <td>: {{ date('d-m-Y', strtotime($detail['tgl_mulai'])) }} s.d {{ date('d-m-Y', strtotime($detail['tgl_akhir'])) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lama Kegiatan</th>
                                            <td>: {{ $detail['total_waktu'].' '.$detail['alias'] }} periode</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Peserta</th>
                                            <td>: {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }} Orang</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-outline card-dark">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/images/browsur/'.$detail['browsur']) }}" alt="{{ $detail['nama_diklat'] }}" width="600">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card card-outline card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Rincian Biaya</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-secondary">
                                                <th><center>No.</center></th>
                                                <th>Nama Pelatihan</th>
                                                <th>Jumlah Peserta</th>
                                                <th>Uraian Biaya</th>
                                                <th>Jumlah[Rp]</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center">1.</td>
                                                <td>{{ $detail['nama_diklat'] }}</td>
                                                <td>{{ $detail['jumlah_peserta'] }} Orang <br>
                                                    @foreach ($resultPeserta as $item)
                                                        <b>-</b> {{ $item->nama }} <br>
                                                    @endforeach
                                                </td>
                                                <td>Rp. {{ number_format($detail['biaya_per_orang'], 2, ',','.') }} x {{ $detail['jumlah_peserta'] }} Orang</td>
                                                <td>Rp. {{ number_format($detail['total_biaya_prelatihan'], 2, ',','.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="right"><b>Total Pembayaran</b></td>
                                                <td>Rp. {{ number_format($detail['total_biaya_prelatihan'], 2, ',','.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('diklat.pendaftaran.admin-metode-pembayaran-mou', ['total_biaya_diklat' => number_format($detail['total_biaya_prelatihan'], 2, ',','.')])

    </section>
@endsection