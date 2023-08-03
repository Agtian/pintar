@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Tarif Pelatihan Pre Klinik</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Data Tarif Pelatihan Pre Klinik</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Tarif Pelatihan Pre Klinik</h3>

                <div class="card-tools">
                    <a href="{{ url('dashboard/admin/master-tarif-pelatihan-pre-klinik/create') }}"
                        class="btn btn-sm btn-primary">Tambah Tarif Pelatihan Pre Klinik</a>
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
                                <th width="50" align="center">No</th>
                                <th>NO SK PERDIR</th>
                                <th>JASA SARANA</th>
                                <th>JASA PELAYANAN</th>
                                <th>JUMLAH TARIF</th>
                                <th>CREATED AT</th>
                                <th width="180">
                                    <center>AKSI</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultTarifPelatihanPreKlinik as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $resultTarifPelatihanPreKlinik->firstItem() - 1 }}</td>
                                    <td>{{ $item->no_perdir }}</td>
                                    <td>{{ $item->jasa_sarana }}</td>
                                    <td>{{ $item->jasa_pelayanan }}</td>
                                    <td>Rp. {{ number_format($item->jumlah_tarif, 2, '.',',') }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td align="center">
                                        <a href="{{ url('dashboard/admin/master-tarif-pelatihan-pre-klinik/' . base64_encode($item->id) . '/edit') }}"
                                            class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i>
                                            Edit</a>
                                        <a href="{{ url('dashboard/admin/master-tarif-pelatihan-pre-klinik/' . base64_encode($item->id) . '/delete') }}"
                                            onclick="return confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="7">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                {{ $resultTarifPelatihanPreKlinik->links() }}
            </div>
        </div>
    </section>
@endsection
