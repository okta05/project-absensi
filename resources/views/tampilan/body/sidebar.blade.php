    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{route('dashboard')}}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder2-open"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Mata Pelajaran</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Kelas</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Tahun Pelajaran</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Absensi</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.view')}}">
                    <i class="bi bi-person-fill"></i>
                    <span>Kelola Data Admin</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('siswa.view')}}">
                    <i class="bi bi-people"></i>
                    <span>Kelola Data Siswa</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#data-pengguna-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Data Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-pengguna-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Kepala Sekolah</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Kurikulum</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data BK</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Wali Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Kelola Data Guru</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->

        </ul>

    </aside><!-- End Sidebar-->