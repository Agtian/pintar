@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pendaftaran Diklat</a></li>
                        <li class="breadcrumb-item active">Data Pendaftaran</li>
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
                                <th>
                                    <center>AKSI</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultDataPendaftaran as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $resultDataPendaftaran->firstItem() - 1 }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tgl_pendaftaran)) }}</td>
                                    <td>
                                        @if ($item->status_pendaftaran == 0)
                                            <button class="btn btn-default btn-sm btn-block" data-toggle="modal" data-target="#modal-belum-dikirim-{{ $item->pendaftaran_diklat_id }}">Belum dikirim</button>
                                            <div class="modal fade" id="modal-belum-dikirim-{{ $item->pendaftaran_diklat_id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Perhatian</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/data-pendaftaran/kirim-permohonan') }}" method="POST">
                                                            @method('POST')
                                                            @csrf
                                                            <input type="hidden" name="kode_data" value="{{ base64_encode($item->pendaftaran_diklat_id) }}">
                                                            <div class="modal-body">
                                                                <p>Surat permohonan yang telah dikirim tidak dapat diubah kembali. Apakah anda yakin akan mengirim surat permohonan diklat? </p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-danger">Kirim Permohonan Diklat</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                                    <td align="center">
                                        <span @if ($item->status_pendaftaran == 1) data-toggle="tooltip" data-placement="top" title="Permohonan diklat yang sudah diajukan tidak dapat diubah kembali." @endif>
                                            <a @if ($item->f_status == 3) href="{{ url('data-pendaftaran/'.base64_encode($item->pendaftaran_diklat_id).'/edit') }}" @endif  class="btn btn-sm btn-outline-primary {{ ($item->status_pendaftaran == 1) ? 'disabled' : '' }}"><i class="fas fa-edit"></i> Ubah Permohonan</a>
                                        </span>
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
            </div>
            <div class="card-footer clearfix">
                {{ $resultDataPendaftaran->links() }}
            </div>
        </div>
    </section>
@endsection
