@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jenis Praktikan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Data Jenis Praktikan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Jenis Praktikan</h3>

                <div class="card-tools">
                    <a href="{{ url('dashboard/admin/master-jenis-praktikan/create') }}"
                        class="btn btn-sm btn-primary">Tambah
                        Jenis Praktikan</a>
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
                                <th>JENIS PRAKTIKAN</th>
                                <th>CREATED AT</th>
                                <th width="180">
                                    <center>AKSI</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultJenisPraktikan as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $resultJenisPraktikan->firstItem() - 1 }}</td>
                                    <td>{{ $item->jenis_praktikan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td align="center">
                                        <a href="{{ url('dashboard/admin/master-jenis-praktikan/' . base64_encode($item->id) . '/edit') }}"
                                            class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i>
                                            Edit</a>
                                        <a href="{{ url('dashboard/admin/master-jenis-praktikan/' . base64_encode($item->id) . '/delete') }}"
                                            onclick="return confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                            Delete</a>
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
                {{ $resultJenisPraktikan->links() }}
            </div>
        </div>
    </section>
@endsection
