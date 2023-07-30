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

                <li class="nav-header">PENDAFTARAN DIKLAT</li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/pendaftaran-diklat') }}"
                        class="nav-link {{ request()->is('dashboard/admin/pendaftaran-diklat') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p class="text">Pendaftaran Peserta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/surat-balasan') }}"
                        class="nav-link {{ request()->is('dashboard/admin/surat-balasan') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-mail-bulk"></i>
                        <p class="text">Surat Balasan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/daftar-peserta') }}"
                        class="nav-link {{ request()->is('dashboard/admin/daftar-peserta') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p class="text">Daftar Peserta</p>
                    </a>
                </li>

                <li class="nav-header">BILLING DIKLAT</li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/pembayaran-diklat') }}"
                        class="nav-link {{ request()->is('dashboard/admin/pembayaran-diklat') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p class="text">Pembayaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/admin/rekap-pendapatan') }}"
                        class="nav-link {{ request()->is('dashboard/admin/rekap-pendapatan') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-file-prescription"></i>
                        <p class="text">Rekap Pendapatan</p>
                    </a>
                </li>

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
                    <a href="{{ url('dashboard/admin/master-honorarium') }}"
                        class="nav-link {{ request()->is('dashboard/admin/master-honorarium') ? 'active bg-primary' : '' }}">
                        <i class="nav-icon fas fa-funnel-dollar"></i>
                        <p>Tarif Honorarium</p>
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
                <br>
                <li class="nav-item {{ request()->segment(1) == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dashboard/dashboard-v1') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('dashboard/dashboard-v1') }}"
                                class="nav-link {{ request()->is('dashboard/dashboard-v1') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard/dashboard-v2') }}"
                                class="nav-link {{ request()->is('dashboard/dashboard-v2') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard/dashboard-v3') }}"
                                class="nav-link {{ request()->is('dashboard/dashboard-v3') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <br>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
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
