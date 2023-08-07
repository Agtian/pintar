@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Daftar MOU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Data Daftar MOU</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Daftar MOU</h3>

                <div class="card-tools">
                    <a href="{{ url('dashboard/admin/master-daftar-mou/create') }}"
                        class="btn btn-sm btn-primary">Tambah MOU Diklat</a>
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
                                <th>NO SURAT</th>
                                <th>TANGGAL</th>
                                <th>BIDANG KERJASAMA</th>
                                <th>INSTANSI</th>
                                <th>KOTA</th>
                                <th>KETERANGAN</th>
                                <th>JANGKA WAKTU</th>
                                <th>STATUS</th>
                                <th width="50">
                                    <center></center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resuldDaftarMOU as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $resuldDaftarMOU->firstItem() - 1 }}</td>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ $item->tgl_mou }}</td>
                                    <td>{{ $item->bidang_kerjasama }}</td>
                                    <td>{{ $item->nama_instansi }}</td>
                                    <td>{{ $item->kota_instansi }}</td>
                                    <td>{{ $item->jabatan_tdd_mou }} <br> {{ $item->nama_ttd_mou }} ({{ $item->nip_tdd_mou }})</td>
                                    <td>{{ date('d F Y', strtotime($item->tgl_mulai_mou)) }}<br>s.d<br>{{ date('d F Y', strtotime($item->tgl_akhir_mou)) }}<br>({{ $item->jangka_waktu_tahun.' tahun' }})</td>
                                    <td align="center">
                                        @if ($item->status_mou == 1)
                                            <button class="btn btn-xs btn-success">Aktif</button>
                                        @else
                                            <button class="btn btn-xs btn-danger">Tidak Aktif</button>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="{{ url('dashboard/admin/master-daftar-mou/' . base64_encode($item->id) . '/edit') }}" class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Edit data"><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                <a href="{{ url('dashboard/admin/master-daftar-mou/' . base64_encode($item->id) . '/delete') }}" class="dropdown-item" data-toggle="tooltip" data-placement="bottom"
                                                    title="Hapus data"><i class="far fa-trash-alt"></i> Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="10">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                {{ $resuldDaftarMOU->links() }}
            </div>
        </div>
    </section>
@endsection
