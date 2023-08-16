<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PINTAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ substr(Auth::user()->name, 0, 20) }}...</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('home-dashboard') }}"
                        class="nav-link {{ request()->is('home-dashboard') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home Dashboard
                        </p>
                    </a>
                </li>

                @if (Auth::user()->role_as != 3 || Auth::user()->role_as != 4)
                    <li class="nav-header">PENDAFTARAN DIKLAT</li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/pendaftaran-diklat') }}"
                            class="nav-link {{ request()->is('dashboard/admin/pendaftaran-diklat') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p class="text">Pendaftaran Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/pendaftaran') }}"
                            class="nav-link {{ request()->is('dashboard/admin/pendaftaran') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon far fa-edit"></i>
                            <p class="text">Pend. Peserta (MOU)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/daftar-peserta') }}"
                            class="nav-link {{ request()->is('dashboard/admin/daftar-peserta') || request()->segment(3) == 'daftar-peserta' ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p class="text">Daftar Peserta</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 3)
                    <li class="nav-header">PENDAFTARAN DIKLAT</li>
                    <li class="nav-item">
                        <a href="{{ url('register-training') }}" class="nav-link"
                            {{ request()->is('/register-training') ? 'active bg-primary' : '' }}>
                            <i class="nav-icon fas fa-edit"></i>
                            <p class="text">Pendaftaran Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p class="text">Daftar Peserta</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_as == 0 || Auth::user()->role_as == 1)
                    <li class="nav-header">PENDAFTARAN PELATIHAN</li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/pendaftaran-pelatihan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/pendaftaran-pelatihan') || request()->segment(4) == 'registrasi' || request()->segment(4) == 'pembayaran' ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p class="text">Pendaftaran Peserta</p>
                        </a>
                    </li>


                    <li class="nav-header">KELOLA PELATIHAN</li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/daftar-pelatihan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/daftar-pelatihan') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fab fa-buromobelexperte"></i>
                            <p class="text">Daftar Pelatihan</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2)
                    <li class="nav-header">BILLING DIKLAT</li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/rekap-pendapatan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/rekap-pendapatan') || request()->is('dashboard/admin/rekap-pendapatan/filter') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-file-prescription"></i>
                            <p class="text">Rekap Pendapatan</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_as == 1)
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/user') }}"
                            class="nav-link {{ request()->is('dashboard/admin/user') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p class="text">Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-pegawai') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-pegawai') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-daftar-mou') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-daftar-mou') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>Daftar MOU</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-honorarium') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-honorarium') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-funnel-dollar"></i>
                            <p>Tarif Honorarium</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-tarif-pelatihan-pre-klinik') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-tarif-pelatihan-pre-klinik') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-comment-dollar"></i>
                            <p>Tarif Pelatihan Pre Klinik</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-tarif-diklat') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-tarif-diklat') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>Tarif Diklat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-jenis-kegiatan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-jenis-kegiatan') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fab fa-stumbleupon-circle"></i>
                            <p>Jenis Kegiatan Diklat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-jenis-praktikan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-jenis-praktikan') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fab fa-stumbleupon"></i>
                            <p>Jenis Praktikan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-satuan-kegiatan') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-satuan-kegiatan') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-business-time"></i>
                            <p>Satuan Kegiatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dashboard/admin/master-unit-kerja') }}"
                            class="nav-link {{ request()->is('dashboard/admin/master-unit-kerja') ? 'active bg-primary' : '' }}">
                            <i class="nav-icon fas fa-universal-access"></i>
                            <p>Unit Kerja</p>
                        </a>
                    </li>
                @endif
                <br>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-window-close"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
