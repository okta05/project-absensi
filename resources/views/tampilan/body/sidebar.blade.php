    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{route('dashboard')}}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if(auth('admin')->check() || auth('kurikulum')->check())
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder2-open"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if(auth('admin')->check())
                    <li>
                        <a href="{{route('mapel.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Mata Pelajaran</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('kelas.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Kelas</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('tahpel.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Tahun Pelajaran</span>
                        </a>
                    </li>
                    @endif

                    @if(auth('kurikulum')->check())
                    <li>
                        <a href="{{route('kelas.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Kelas</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </li><!-- End Icons Nav -->
            @endif

            @if(auth('admin')->check())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.view')}}">
                    <i class="bi bi-person-fill"></i>
                    <span>Kelola Data Admin</span>
                </a>
            </li><!-- End Profile Page Nav -->
            @endif

            @if(auth('admin')->check() || auth('kepsek')->check())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('siswa.view')}}">
                    <i class="bi bi-people"></i>
                    <span>Kelola Data Siswa</span>
                </a>
            </li><!-- End Profile Page Nav -->
            @endif

            @if(auth('admin')->check())
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#data-pengguna-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Data Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-pengguna-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('kepsek.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Kepala Sekolah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('kurikulum.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Kurikulum</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('bk.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data BK</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('wakel.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Wali Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('guru.view')}}">
                            <i class="bi bi-circle"></i><span>Kelola Data Guru</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->
            @endif

            @if(auth('admin')->check() || auth('kepsek')->check())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('mapel.absensi')}}">
                    <i class="bi bi-book"></i>
                    <span>Absensi</span>
                </a>
            </li><!-- End Profile Page Nav -->
            @endif


        </ul>

    </aside><!-- End Sidebar-->