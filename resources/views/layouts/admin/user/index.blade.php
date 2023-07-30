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

        @if (session('message'))
            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
        @endif

        <a href="{{ url('/dashboard/admin/user/create') }}" class="btn btn-md btn-primary mb-2">Add User</a>

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
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role As</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_as == 1)
                                            <span class="badge badge-primary">Admin</span>
                                        @else
                                            <span class="badge badge-success">User</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/admin/user/' . $user->id . '/edit') }}"
                                            class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i>
                                            Edit</a>
                                        <a href="{{ url('dashboard/admin/user/' . $user->id . '/delete') }}"
                                            onclick="return confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
