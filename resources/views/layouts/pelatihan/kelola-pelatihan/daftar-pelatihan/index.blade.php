@push('style')
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pelatihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Pelatihan</a></li>
                        <li class="breadcrumb-item active">Data Daftar Pelatihan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @include('inc.alert')

        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Daftar Pelatihan</h3>

                <div class="card-tools">
                    <a href="{{ url('dashboard/admin/daftar-pelatihan/create') }}"
                        class="btn btn-sm btn-primary">Tambah Daftar Pelatihan</a>
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
                                <th>NAMA PELATIHAN</th>
                                <th>TANGGAL</th>
                                <th>BIAYA PER ORANG</th>
                                <th>MAX PESERTA</th>
                                <th width="120">BROSUR</th>
                                <th>CATATAN</th>
                                <th width="120">STATUS</th>
                                <th width="180">
                                    <center>AKSI</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultDaftarPelatihan as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $resultDaftarPelatihan->firstItem() - 1 }}</td>
                                    <td>{{ $item->nama_diklat }}</td>
                                    <td>{{ $item->tgl_mulai }} <br>s.d <br>{{ $item->tgl_selesai }}</td>
                                    <td>{{ $item->biaya_per_orang }}</td>
                                    <td>{{ $item->role_max_peserta }}</td>
                                    <td>
                                        <div class="filtr-item" data-category="2, 4" data-sort="black sample">
                                            <a href="{{ asset('assets/images/browsur').'/'.$item->browsur }}" data-toggle="lightbox" data-title="{{ $item->nama_diklat }}">
                                                <img src="{{ asset('assets/images/browsur').'/'.$item->browsur }}" class="img-fluid mb-2" alt="black sample"/>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->catatan }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <button class="btn btn-sm btn-dark btn-block">Hidden</button>
                                        @elseif ($item->status == 1)
                                            <button class="btn btn-sm btn-success btn-block">Aktif</button>
                                        @else
                                            <button class="btn btn-sm btn-dark btn-block">Tidak Aktif</button>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <a href="{{ url('dashboard/admin/daftar-pelatihan/' . base64_encode($item->id) . '/edit') }}"
                                            class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i>
                                            Edit</a>
                                        <a href="{{ url('dashboard/admin/daftar-pelatihan/' . base64_encode($item->id) . '/delete') }}"
                                            onclick="return confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                            Delete</a>
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
                {{ $resultDaftarPelatihan->links() }}
            </div>
        </div>
    </section>
@endsection

@push('script')
    <!-- Ekko Lightbox -->
    <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <!-- Filterizr-->
    <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>

    <script>
        $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    
        $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
        })
    </script>
@endpush
