<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo-rev1.png') }}" alt="" style="height: 200px;">
            <span class="d-none d-lg-block">Absensi SMPN 2 SEMPU</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <!-- Menampilkan Foto Profil -->
                    <img src="
                        @if (Auth::guard('kepsek')->check())
                            {{ asset('storage/' . Auth::guard('kepsek')->user()->foto) }}
                        @elseif (Auth::guard('admin')->check())
                            {{ asset('storage/' . Auth::guard('admin')->user()->foto_admin) }}
                        @elseif (Auth::guard('kurikulum')->check())
                            {{ asset('storage/' . Auth::guard('kurikulum')->user()->foto) }}
                        @elseif (Auth::guard('bk')->check())
                            {{ asset('storage/' . Auth::guard('bk')->user()->foto) }}
                        @elseif (Auth::guard('wakel')->check())
                            {{ asset('storage/' . Auth::guard('wakel')->user()->foto) }}
                        @elseif (Auth::guard('guru')->check())
                            {{ asset('storage/' . Auth::guard('guru')->user()->foto) }}
                        @elseif (Auth::guard('web')->check())
                            {{ asset('storage/' . Auth::guard('web')->user()->foto) }}
                        @endif
                    " alt="Profile" class="rounded-circle">

                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        @if (Auth::guard('kepsek')->check())
                        {{ Auth::guard('kepsek')->user()->nama }}
                        @elseif (Auth::guard('admin')->check())
                        {{ Auth::guard('admin')->user()->nama }}
                        @elseif (Auth::guard('kurikulum')->check())
                        {{ Auth::guard('kurikulum')->user()->nama }}
                        @elseif (Auth::guard('bk')->check())
                        {{ Auth::guard('bk')->user()->nama }}
                        @elseif (Auth::guard('wakel')->check())
                        {{ Auth::guard('wakel')->user()->nama }}
                        @elseif (Auth::guard('guru')->check())
                        {{ Auth::guard('guru')->user()->nama }}
                        @elseif (Auth::guard('web')->check())
                        {{ Auth::guard('web')->user()->name }}
                        @endif
                    </span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            @if (Auth::guard('kepsek')->check())
                            {{ Auth::guard('kepsek')->user()->nama }}
                            @elseif (Auth::guard('admin')->check())
                            {{ Auth::guard('admin')->user()->nama }}
                            @elseif (Auth::guard('kurikulum')->check())
                            {{ Auth::guard('kurikulum')->user()->nama }}
                            @elseif (Auth::guard('bk')->check())
                            {{ Auth::guard('bk')->user()->nama }}
                            @elseif (Auth::guard('wakel')->check())
                            {{ Auth::guard('wakel')->user()->nama }}
                            @elseif (Auth::guard('guru')->check())
                            {{ Auth::guard('guru')->user()->nama }}
                            @elseif (Auth::guard('web')->check())
                            {{ Auth::guard('web')->user()->name }}
                            @endif
                        </h6>
                        <span>
                            @if (Auth::guard('kepsek')->check())
                            Kepala Sekolah
                            @elseif (Auth::guard('admin')->check())
                            Admin
                            @elseif (Auth::guard('kurikulum')->check())
                            Kurikulum
                            @elseif (Auth::guard('bk')->check())
                            BK
                            @elseif (Auth::guard('wakel')->check())
                            Wali Kelas
                            @elseif (Auth::guard('guru')->check())
                            Guru
                            @elseif (Auth::guard('web')->check())
                            User
                            @endif
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="get" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->