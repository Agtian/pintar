@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Daftar Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                        <li class="breadcrumb-item active">Data Daftar Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Daftar Peserta</h3>

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
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">NO</th>
                                        <th>INSTANSI / SEKOLAH</th>
                                        <th>TANGGAL DIKLAT</th>
                                        <th>DETAIL BIAYA RETRIBUSI</th>
                                        <th>STATUS</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($resultDaftarPeserta as $item)
                                        <tr>
                                            <td align="center">
                                                {{ $loop->iteration + $resultDaftarPeserta->firstItem() - 1 }}</td>
                                            <td>{{ $item->nama_instansi }}</td>
                                            <td align="center">
                                                {{ date('d/m/Y', strtotime($item->tgl_mulai)) }} <br>
                                                s.d <br>
                                                {{ date('d/m/Y', strtotime($item->tgl_akhir)) }}
                                            </td>
                                            <td>
                                                @if ($item->tarif_honorarium)
                                                    {{ $item->nama_kegiatan . ' ' . $item->jenis_praktikan . ' Rp. ' . number_format($item->jumlah, 2, '.', ',') . ' x ' . $item->jumlah_peserta . ' orang x ' . $item->total_waktu . ' ' . $item->alias }}
                                                    <br>
                                                    Honorarium CI : Rp.
                                                    {{ number_format($item->tarif_honorarium, 2, '.', ',') . ' x ' . $item->jumlah_peserta . ' orang x ' . $item->total_waktu . ' ' . $item->alias }}
                                                    <hr>
                                                    Total biaya Rp.
                                                    {{ number_format($item->total_tarif, 2, '.', ',') }}
                                                @else
                                                    {{ $item->nama_kegiatan . ' ' . $item->jenis_praktikan . ' Rp. ' . number_format($item->jumlah, 2, '.', ',') . ' x ' . $item->jumlah_peserta . ' orang x ' . $item->total_waktu . ' ' . $item->alias }}
                                                    <hr>
                                                    Total biaya Rp.
                                                    {{ number_format($item->total_tarif, 2, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status_pendaftaran == 0)
                                                    <button class="btn btn-sm btn-secondary">Pending Peserta</button>
                                                @elseif ($item->status_pendaftaran == 1)
                                                    <button class="btn btn-sm btn-danger">Aktif, belum lunas</button>
                                                @elseif ($item->status_pendaftaran == 2)
                                                    <button class="btn btn-sm btn-success">Aktif, sudah lunas</button>
                                                @elseif ($item->status_pendaftaran == 3)
                                                    <button class="btn btn-sm btn-primary">Selesai, sudah lunas</button>
                                                    @elseif ($item->status_pendaftaran == 4)
                                                    <button class="btn btn-sm btn-dark">Batal</button>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <button type="button" class="btn btn-sm btn-outline-info m-1"
                                                    data-toggle="modal"
                                                    data-target="#modal-detail-{{ $item->pendaftaran_diklat_id }}"><i
                                                        class="nav-icon fas fa-eye"></i></button>
                                                <a href="{{ url('dashboard/admin/daftar-peserta/' . base64_encode($item->kode_pendaftaran) . '/edit') }}"
                                                    class="btn btn-sm btn-outline-warning m-1"><i
                                                        class="nav-icon fas fa-edit"></i></a>
                                                <a href="" class="btn btn-sm btn-outline-danger m-1"><i
                                                        class="nav-icon fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" align="center"></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                {{ $resultDaftarPeserta->links() }}
            </div>
        </div>
    </section>

    @foreach ($resultDaftarPeserta as $item)
        <div class="modal fade" id="modal-detail-{{ $item->pendaftaran_diklat_id }}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rincian Peserta Diklat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <td width="150">Nama Instansi</td>
                                <td>: {{ $item->nama_instansi }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Diklat</td>
                                <td>: {{ $item->tgl_mulai . ' s.d ' . $item->tgl_akhir }}
                                    ({{ $item->total_waktu . ' ' . $item->alias }})
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Peserta</td>
                                <td>: {{ $item->jumlah_peserta }} orang</td>
                            </tr>
                            <tr>
                                <td>Rincian Biaya</td>
                                <td>:
                                    {{ $item->nama_kegiatan . ' ' . $item->jenis_praktikan . ' Rp. ' . number_format($item->jumlah, 2, '.', ',') . ' x jumlah peserta ' . $item->jumlah_peserta . ' orang x lama kegiatan ' . $item->total_waktu . ' ' . $item->alias }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total Biaya</td>
                                <td>: Rp. {{ number_format($item->total_tarif, 2, '.', ',') }}</td>
                            </tr>
                            <tr>
                                <td>Unduh Dokumen</td>
                                <td>:
                                    <a href="" class="btn btn-sm btn-primary" target="_blank">Surat Permohonan
                                        Diklat</a>
                                    <a href="" class="btn btn-sm btn-primary" target="_blank">Surat Balasan</a>
                                    <a href="" class="btn btn-sm btn-primary" target="_blank">Retribusi</a>
                                </td>
                            </tr>
                        </table>

                        @livewire('diklat.daftar-peserta.modal-table-peserta-diklat', ['send_pendaftaran_diklat_id' => $item->pendaftaran_diklat_id])

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark float-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
