@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

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
                <h3 class="card-title">Filter</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('dashboard/admin/rekap-pendapatan/filter') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-2 col-form-label">Periode Tanggal</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror" id="tgl_awal" name="tgl_awal" value="{{ old('tgl_awal') }}">
                            @error('tgl_awal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="tgl_akhir" class="col-form-label">s.d</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" id="tgl_akhir" name="tgl_akhir" value="{{ old('tgl_akhir') }}">
                            @error('tgl_akhir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_bill" class="col-sm-2 col-form-label">Status Bill</label>
                        <div class="col-sm-6">
                            <select name="status_bill" id="status_bill" class="form-control @error('status_bill') is-invalid @enderror">
                                <option value="">-- Pilih status bill --</option>
                                <option value="viewAll">Tampilkan semua data</option>
                                <option value="0">Belum lunas</option>
                                <option value="1">Lunas</option>
                                <option value="2">Batal</option>
                                <option value="4">Pending Peserta</option>
                            </select>
                            @error('status_bill')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
                    <div class="col-sm-12">
                        <blockquote class="quote-secondary">
                            <table>
                                <tr>
                                    <td width="80">Periode</td>
                                    <td>: {{ $tgl_awal. ' s.d '.$tgl_akhir }}</td>
                                </tr>
                                <tr>
                                    <td width="80">Status Bill</td>
                                    <td>: {{ $status_bill }}</td>
                                </tr>
                            </table>
                        </blockquote>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive p-2">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>STATUS BILL & REG</th>
                                        <th>NAMA</th>
                                        <th>RINCIAN BIAYA</th>
                                        <th>JUMLAH</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($resultRekapPendapatan as $item)
                                        <tr>
                                            <td width="50" align="center">{{ $no++ }}</td>
                                            <td>
                                                Reg : {{ date('d/m/Y H:i', strtotime($item->tgl_pendaftaran)) }} <br>
                                                User Reg : {{ $item->name_reg == null ? '-' : substr($item->name_reg, 0, 10).'...' }} <br>
                                                Pay : {{ $item->tgl_bayar == null ? '-' : date('d/m/Y H:i', strtotime($item->tgl_bayar)) }} <br>
                                                User Bill : {{ $item->name_bill == null ? '-' : substr($item->name_bill, 0, 10).'...' }}
                                            </td>
                                            <td>
                                                @if ($item->f_status == 0)
                                                    <button class="btn btn-outline-danger btn-xs btn-block"><i class="icon fas fa-exclamation-triangle"></i> Bill : Belum lunas</button>
                                                @elseif($item->f_status == 1)
                                                    <button class="btn btn-outline-success btn-xs btn-block"><i class="icon fas fa-check"></i> Bill : Lunas</button>
                                                @elseif($item->f_status == 2)
                                                    <button class="btn btn-outline-dark btn-xs btn-block"><i class="icon fas fa-exclamation-triangle"></i> Bill : Batal</button>
                                                @elseif($item->f_status == 3)
                                                    <button class="btn btn-outline-secondary btn-xs btn-block"><i class="icon fas fa-ban"></i> Bill : Pending</button>
                                                @endif
                                                <hr>
                                                @if ($item->status_pendaftaran == 0)
                                                    <button class="btn btn-outline-secondary btn-xs btn-block"><i class="icon fas fa-ban"></i> Reg : Pending peserta</button>
                                                @elseif($item->status_pendaftaran == 1)
                                                    <button class="btn btn-outline-danger btn-xs btn-block"><i class="icon fas fa-exclamation-triangle"></i> Reg : Aktif, belum lunas</button>
                                                @elseif($item->status_pendaftaran == 2)
                                                    <button class="btn btn-outline-success btn-xs btn-block"><i class="icon fas fa-check"></i> Reg : Aktif, lunas</button>
                                                @elseif($item->status_pendaftaran == 3)
                                                    <button class="btn btn-outline-success btn-xs btn-block"><i class="icon fas fa-check"></i> Reg : Selesai, lunas</button>
                                                @elseif($item->status_pendaftaran == 4)
                                                    <button class="btn btn-outline-dark btn-xs btn-block"><i class="icon fas fa-window-close"></i> Reg : Batal</button>
                                                @endif

                                            </td>
                                            <td>{{ $item->nama_instansi }}</td>
                                            <td>
                                                <u>Biaya {{ $item->nama_kegiatan.' '.$item->jenis_praktikan.' : Rp '.number_format($item->jumlah, 2, ',','.') }}</u> <b>*</b> <u>{{ $item->total_waktu.' '.$item->alias }}</u> <b>*</b> <u>{{ $item->jumlah_peserta }} peserta</u>
                                                @if ($item->tarif_honorarium != 0)
                                                    <hr>
                                                    <u>Biaya Honorarium CI : Rp {{ $item->tarif_honorarium }}</u> <b>*</b> <u>{{ $item->jumlah_peserta }} peserta</u>
                                                @endif
                                                @if ($item->jumlah_peserta_tambahan != 0)
                                                    <hr>
                                                    <u>Biaya Pel. Kompetensi Dasar & Kredensial : Rp {{ $item->tarif_pre_klinik }}</u> <b>*</b> <u>{{ $item->jumlah_peserta_tambahan }} peserta</u>
                                                @endif
                                            </td>
                                            <td>
                                                Rp {{ number_format(($item->jumlah * $item->jumlah_peserta * $item->total_waktu), 2, ',','.') }}
                                                @if ($item->tarif_honorarium != 0)
                                                    <hr>
                                                    Rp {{ number_format(($item->tarif_honorarium * $item->jumlah_peserta), 2, ',','.') }}
                                                @endif
                                                @if ($item->jumlah_peserta_tambahan != 0)
                                                    <hr>
                                                    Rp {{ number_format(($item->tarif_pre_klinik * $item->jumlah_peserta_tambahan), 2, ',','.') }}
                                                @endif
                                            </td>
                                            <td>
                                                Rp {{ number_format($item->total_tarif, 2, ',','.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" align="center">Data tidak tersedia !</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, 
                "lengthChange": true, // false
                "autoWidth": true, // false
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush