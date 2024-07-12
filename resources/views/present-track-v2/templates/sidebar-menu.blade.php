<div class="sidebar-menu">
    <ul id="accordion-menu">
        <li>
            <a href="{{ route('dashboard') }}"
                class="dropdown-toggle no-arrow {{ @$menuActive == 'home' ? 'active' : '' }}">
                <span class="micon bi bi-house"></span><span class="mtext">Home</span>
            </a>
        </li>

        @if (Auth::user()->role == 'superuser')
            <li class="mt-4">
                <div class="sidebar-small-cap">Superadmin</div>
            </li>

            <li>
                <a href="{{ route('manage.academic.year') }}"
                    class="dropdown-toggle no-arrow {{ @$menuActive == 'Tahun Ajaran' ? 'active' : '' }}">
                    <span class="micon bi bi-boxes"></span><span class="mtext">Setting Tahun Ajaran</span>
                </a>
            </li>

            <li class="mt-4">
                <div class="sidebar-small-cap">Modul</div>
            </li>

            <li class="dropdown {{ $menuOpen == 'Master Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-hdd-stack"></span
                    ><span class="mtext">Master Data</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Master Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.guru') }}" class="{{ $menuActive == 'Data Guru'  ? 'active' : ''}}" >Data Guru</a></li>
                    <li><a href="javascript:;">Data Staff</a></li>
                    <li><a href="javascript:;">Data Siswa</a></li>
                    <li><a href="{{ route('manage.major') }}" class="{{ $menuActive == 'Data Major'  ? 'active' : ''}}" >Data Jurusan</a></li>
                    <li><a href="{{ route('manage.class') }}" class="{{ $menuActive == 'Data Kelas'  ? 'active' : ''}}">Data Kelas</a></li>
                </ul>
            </li>

            <li class="dropdown {{ $menuOpen == 'Report Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-files"></span
                    ><span class="mtext">Laporan</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Report Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.report.absenGuru') }}" class="{{ $menuActive == 'Laporan Absen'  ? 'active' : ''}}">LOG Absen</a></li>
                    <li><a href="{{ route('manage.report.harian') }}" class="{{ $menuActive == 'Laporan Harian'  ? 'active' : ''}}">Laporan Harian</a></li>
                    <li><a href="{{ route('manage.report.mingguan') }}" class="{{ $menuActive == 'Laporan Mingguan'  ? 'active' : ''}}">Laporan Mingguan</a></li>
                    <li><a href="{{ route('manage.report.bulanan') }}" class="{{ $menuActive == 'Laporan Bulanan'  ? 'active' : ''}}">Laporan Bulanan</a></li>
                </ul>
            </li>

            <li class="mt-4">
                <div class="sidebar-small-cap">Akademik</div>
            </li>

            <li>
                <a href="{{ route('manage.subject') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Mapel' ? 'active' : '' }}">
                    <span class="micon bi bi-book"></span><span class="mtext">Data Mapel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage.days') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Waktu' ? 'active' : '' }}">
                    <span class="micon bi bi-alarm"></span><span class="mtext">Data Waktu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage.schedules') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Jadwal' ? 'active' : '' }}">
                    <span class="micon bi bi-person-lines-fill"></span><span class="mtext">Jadwal KBM</span>
                </a>
            </li>

            <li class="mt-4">
                <div class="sidebar-small-cap">Authentication</div>
            </li>

            <li>
                <a href="{{ route('manage.auth.guru') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Akun Guru' ? 'active' : '' }}">
                    <span class="micon bi bi-key-fill"></span><span class="mtext">Akun Guru</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->role == "admin")
            <li class="mt-4">
                <div class="sidebar-small-cap">Modul</div>
            </li>

            <li class="dropdown {{ $menuOpen == 'Master Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-hdd-stack"></span
                    ><span class="mtext">Master Data</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Master Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.guru') }}" class="{{ $menuActive == 'Data Guru'  ? 'active' : ''}}" >Data Guru</a></li>
                    <li><a href="{{ route('manage.major') }}" class="{{ $menuActive == 'Data Major'  ? 'active' : ''}}" >Data Jurusan</a></li>
                    <li><a href="{{ route('manage.class') }}" class="{{ $menuActive == 'Data Kelas'  ? 'active' : ''}}">Data Kelas</a></li>
                </ul>
            </li>

            <li class="dropdown {{ $menuOpen == 'Report Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-files"></span
                    ><span class="mtext">Laporan</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Report Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.report.absenGuru') }}" class="{{ $menuActive == 'Laporan Absen'  ? 'active' : ''}}">LOG Absen</a></li>
                    <li><a href="{{ route('manage.report.harian') }}" class="{{ $menuActive == 'Laporan Harian'  ? 'active' : ''}}">Laporan Harian</a></li>
                    <li><a href="{{ route('manage.report.mingguan') }}" class="{{ $menuActive == 'Laporan Mingguan'  ? 'active' : ''}}">Laporan Mingguan</a></li>
                    <li><a href="{{ route('manage.report.bulanan') }}" class="{{ $menuActive == 'Laporan Bulanan'  ? 'active' : ''}}">Laporan Bulanan</a></li>
                </ul>
            </li>

            <li class="mt-4">
                <div class="sidebar-small-cap">Akademik</div>
            </li>

            <li>
                <a href="{{ route('manage.subject') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Mapel' ? 'active' : '' }}">
                    <span class="micon bi bi-book"></span><span class="mtext">Data Mapel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage.days') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Waktu' ? 'active' : '' }}">
                    <span class="micon bi bi-alarm"></span><span class="mtext">Data Waktu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage.schedules') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Jadwal' ? 'active' : '' }}">
                    <span class="micon bi bi-person-lines-fill"></span><span class="mtext">Jadwal KBM</span>
                </a>
            </li>

            <li class="mt-4">
                <div class="sidebar-small-cap">Authentication</div>
            </li>

            <li>
                <a href="{{ route('manage.auth.guru') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Akun Guru' ? 'active' : '' }}">
                    <span class="micon bi bi-key-fill"></span><span class="mtext">Akun Guru</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 'staff')
            <li class="mt-4">
                <div class="sidebar-small-cap">Staff</div>
            </li>

            <li class="dropdown {{ $menuOpen == 'Master Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-hdd-stack"></span
                    ><span class="mtext">Master Data</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Master Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.guru') }}" class="{{ $menuActive == 'Data Guru'  ? 'active' : ''}}" >Data Guru</a></li>
                    <li><a href="" class="{{ $menuActive == 'Data Staff'  ? 'active' : ''}}">Data Staff</a></li>
                </ul>
            </li>

            <li class="dropdown {{ $menuOpen == 'Report Data' ? 'show' : '' }}">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-files"></span
                    ><span class="mtext">Laporan</span>
                </a>
                <ul class="submenu" style="{{ $menuOpen == 'Report Data' ? 'display:block;' : 'display:none;' }}">
                    <li><a href="{{ route('manage.report.absenGuru') }}" class="{{ $menuActive == 'Laporan Absen'  ? 'active' : ''}}">LOG Absen</a></li>
                    <li><a href="{{ route('manage.report.harian') }}" class="{{ $menuActive == 'Laporan Harian'  ? 'active' : ''}}">Laporan Harian</a></li>
                    <li><a href="{{ route('manage.report.mingguan') }}" class="{{ $menuActive == 'Laporan Mingguan'  ? 'active' : ''}}">Laporan Mingguan</a></li>
                    <li><a href="{{ route('manage.report.bulanan') }}" class="{{ $menuActive == 'Laporan Bulanan'  ? 'active' : ''}}">Laporan Bulanan</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('manage.permission') }}"
                    class="dropdown-toggle no-arrow {{ $menuActive == 'Data Izin' ? 'active' : '' }}">
                    <span class="micon fa fa-shield"></span><span class="mtext">Setujui Izin</span>
                </a>
            </li>


        @endif
        <li>
            <a onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                href="{{ route('auth.logout') }}" class="dropdown-toggle no-arrow">
                <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
            </a>
        </li>

        <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST"
            style="display: none;">
            @csrf
        </form>

    </ul>
</div>
