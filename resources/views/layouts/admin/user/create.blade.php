@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Data Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">

                @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                <div class="card card-dark">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Tabel Data User</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ url('dashboard/admin/user') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <div class="select2-purple">
                                        <select class="form-control" id="select-pegawai" name="pegawai_id[]"
                                            multiple="multiple" data-placeholder="Select a State"
                                            data-dropdown-css-class="select2-purple" style="width: 100%;"></select>
                                    </div>
                                    @error('pegawai_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" placeholder="Password"
                                        autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_as"
                                    class="col-sm-3 col-form-label @error('role_as') is-invalid @enderror">Confirm
                                    Password</label>
                                <div class="col-sm-9">
                                    <select name="role_as" id="role_as" class="form-control">
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#select-pegawai').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: 'Cari nama pegawai',
                ajax: {
                    dataType: 'json',
                    url: {{ url('api/fetch-get-pegawai') }},
                    delay: 800,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            })
        });
    </script>
@endpush
