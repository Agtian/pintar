@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Resume Pendaftaran Diklat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                        <li class="breadcrumb-item">Form Pendaftaran</li>
                        <li class="breadcrumb-item active">Resume Pendaftaran Diklat</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Permohonan Diklat</h3>
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
                                            <th>Nama Instansi</th>
                                            <td>: {{ $detail['nama_instansi'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kota Instansi</th>
                                            <td>: {{ $detail['kota_instansi'] }}</td>
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
                                            <td>: {{ date('d-m-Y', strtotime($detail['tgl_mulai'])) }} s.d
                                                {{ date('d-m-Y', strtotime($detail['tgl_akhir'])) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lama Kegiatan</th>
                                            <td>: {{ $detail['total_waktu'] . ' ' . $detail['alias'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Peserta</th>
                                            <td>: {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }} Orang
                                            </td>
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
                                                <embed
                                                    src="{{ asset('assets/dokumen/surat_permohonan_diklat/' . $detail['file_surat_permohonan']) }}"
                                                    width="100%" height="310" />
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
                                                <th>
                                                    <center>No.</center>
                                                </th>
                                                <th>Keterangan</th>
                                                <th>Uraian Pembayaran</th>
                                                <th>Biaya</th>
                                                <th>Jumlah[Rp]</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center">1.</td>
                                                <td>Biaya Diklat (Pergub Jateng Nomor 58 tahun 2020)</td>
                                                <td>Biaya {{ $detail['nama_kegiatan'] . ' ' . $detail['jenis_praktikan'] }}
                                                    <b>x</b> {{ $detail['total_waktu'] . ' ' . $detail['alias'] }} x
                                                    {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }}
                                                    Orang
                                                </td>
                                                <td>Biaya Rp. {{ number_format($detail['jumlah'], 2, ',', '.') }} <b>x</b>
                                                    {{ $detail['total_waktu'] . ' ' . $detail['alias'] }} <b>x</b>
                                                    {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }}
                                                    Orang</td>
                                                <td width="150">Rp. {{ number_format($detail['total_tarif_praktik'], 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">2.</td>
                                                <td>Pelatihan Kompetensi Dasar & Kredensial (Perdir nomor 910/304/V11/2023)
                                                </td>
                                                <td>Biaya Pelatihan Kompetensi Dasar & Kredensial <b>x</b>
                                                    {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }}
                                                    Orang</td>
                                                <td width="320">Biaya Rp.
                                                    {{ number_format($detail['tarif_pre_klinik'], 2, ',', '.') }} <b>x</b>
                                                    {{ $detail['jumlah_peserta'] + $detail['jumlah_peserta_tambahan'] }}
                                                    Orang</td>
                                                <td width="140">Rp.
                                                    {{ number_format($detail['total_tarif_pre_klinik'], 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="right"><b>Total Pembayaran</b></td>
                                                <td>Rp. {{ number_format($detail['total_biaya_diklat'], 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form action="{{ url('register-training/kirim') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pendaftaran_diklat_id"
                        value="{{ base64_encode($detail['pendaftaran_diklat_id']) }}">
                    <button type="submit" class="btn btn-primary float-right">Kirim Permohonan Diklat</button>
                </form>
                <form action="{{ url('register-training/batal') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pendaftaran_diklat_id"
                        value="{{ base64_encode($detail['pendaftaran_diklat_id']) }}">
                    <button type="submit" class="btn btn-danger float-right  mr-1">Batalkan Pengajuan Diklat</button>
                </form>
            </div>
        </div>

    </section>
@endsection
