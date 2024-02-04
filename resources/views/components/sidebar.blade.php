    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Presensi SMK Patriot</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ $menuActive == null ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    @if (Auth::user()->role == 'kepsek')
                        <li class="nav-header">Menu Kepala Sekolah</li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.monitor') }}"
                                class="nav-link {{ $menuActive == 'monitor' ? 'active' : '' }}">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>
                                    Monitor Kelas
                                </p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="/absen" class="nav-link {{ $menuActive == 'absen' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-person-booth"></i>
                                <p>
                                    Log Absen Guru
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wakasek.staff.log') }}"
                                class="nav-link {{ $menuActive == 'logStaff' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-person-booth"></i>
                                <p>
                                    Log Absen Staff
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'superuser' || Auth::user()->role == 'user')
                        <li class="nav-header">Menu Guru</li>
                        <li class="nav-item {{ $menuOpen == 'master' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $menuOpen == 'master' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Data Master Guru
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/guru" class="nav-link {{ $menuActive == 'guru' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Guru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kelas" class="nav-link {{ $menuActive == 'kelas' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jurusan" class="nav-link {{ $menuActive == 'jurusan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Jurusan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/waktu" class="nav-link {{ $menuActive == 'waktu' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Master Jam</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/master-jadwal"
                                        class="nav-link {{ $menuActive == 'master-jadwal' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Master Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jadwal" class="nav-link {{ $menuActive == 'jadwal' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Jadwal Guru</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/absen" class="nav-link {{ $menuActive == 'absen' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-person-booth"></i>
                                <p>
                                    Catatan Absen
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/android" class="nav-link {{ $menuActive == 'akunGuru' ? 'active' : '' }}">
                                <i class="fas fa-server nav-icon"></i>
                                <p>
                                    Akun Guru
                                </p>
                            </a>
                        </li>

                        <li class="nav-item {{ $menuOpen == 'report' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $menuOpen == 'report' ? 'active' : '' }}">
                                <i class="fas fa-server nav-icon"></i>
                                <p>
                                    Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('report.harian') }}"
                                        class="nav-link {{ $menuActive == 'harian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('report.mingguan') }}"
                                        class="nav-link {{ $menuActive == 'mingguan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mingguan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('report.bulanan') }}"
                                        class="nav-link {{ $menuActive == 'bulanan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bulanan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.monitor') }}"
                                class="nav-link {{ $menuActive == 'monitor' ? 'active' : '' }}">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>
                                    Monitor Kelas
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'superuser' || Auth::user()->role == 'wakasek')
                        <li class="nav-header">Menu Staff</li>
                        <li class="nav-item {{ $menuOpen == 'masterStaff' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $menuActive == 'masterStaff' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Data Master Staff
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('wakasek.staff') }}"
                                        class="nav-link {{ $menuActive == 'masterStaff' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Staff</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('wakasek.staff.akun') }}"
                                        class="nav-link {{ $menuActive == 'akunStaff' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Akun Staff</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('wakasek.staff.log') }}"
                                class="nav-link {{ $menuActive == 'logStaff' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-person-booth"></i>
                                <p>
                                    Log Absen Staff
                                </p>
                            </a>
                        </li>
                    @endif



                    <li class="nav-header">Menu Siswa</li>
                    <li class="nav-item {{ $menuOpen == 'masterSiswa' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $menuOpen == 'masterSiswa' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Data Master Siswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/siswa" class="nav-link {{ $menuActive == 'siswa' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    @if (Auth::user()->role == 'superuser')
                        <li class="nav-header">Menu Superuser</li>
                        <li class="nav-item">
                            <a href="/operator" class="nav-link {{ $menuActive == 'operator' ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>
                                    Operator
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-code nav-icon"></i>
                                <p>
                                    Api
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('superuser.database') }}"
                                class="nav-link {{ $menuActive == 'database' ? 'active' : '' }}">
                                <i class="fas fa-database nav-icon"></i>
                                <p>
                                    Database
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                    @endif



                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
