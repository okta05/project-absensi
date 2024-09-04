@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{route("mapel.absensi")}}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a href="#">Absensi</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if($mapel)
    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <div class="col-8 border border-3 p-3 mt-3 rounded shadow-sm">
                    <div class="tab-content pt-1">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Mata Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">{{ $mapel->nm_mapel }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kode Mata Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">{{ $mapel->kd_mapel }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kelas</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">{{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Guru</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">{{ $mapel->guru->nama ?? 'Guru Tidak Ditemukan' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Tahun Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->tahpel->th_pelajaran ?? 'Tahun Pelajaran Tidak Ditemukan' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                @if(auth('admin')->check() || auth('bk')->check() || auth('wakel')->check() || auth('guru')->check() ||
                auth('kepsek')->check())

                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        @if(auth('admin')->check() || auth('bk')->check() || auth('wakel')->check() ||
                        auth('guru')->check() ||auth('kepsek')->check())

                        <a href="{{ route('add.absensi', ['id_mapel' => $mapel->id_mapel]) }}"
                            class="btn btn-success me-2">
                            <i class="bi bi-journal-plus"></i> Tambah
                        </a>
                        <a href="{{ route('absensi.perbulan', ['id_mapel' => $mapel->id_mapel]) }}"
                            class="btn btn-primary me-2">
                            <i class="bi bi-download"></i> Unduh Per Bulan
                        </a>
                        <a href="{{ route('absensi.persemester', ['id_mapel' => $mapel->id_mapel]) }}"
                            class="btn btn-primary">
                            <i class="bi bi-download"></i> Unduh Per Semester
                        </a>
                        @endif

                    </div>
                </div>

                @endif

                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Jam</th>
                                    @if(auth('admin')->check() || auth('kepsek')->check() || auth('bk')->check() ||
                                    auth('wakel')->check())
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allDataAbsensi as $key => $absen)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $absen->mapel->nm_mapel ?? 'tidak ditemukan' }}</td>
                                    <td>{{ $absen->mapel->kd_mapel ?? 'tidak ditemukan' }}</td>
                                    <td>{{ $absen->mapel->semester ?? 'tidak ditemukan' }}</td>
                                    <td>{{ $absen->jam }}</td>
                                    <td>

                                        @if(auth('admin')->check() || auth('kepsek')->check() || auth('bk')->check() ||
                                        auth('wakel')->check())
                                        <div class="d-flex gap-2">
                                            @if(auth('admin')->check() || auth('bk')->check() || auth('wakel')->check())
                                            <a class="btn btn-primary"
                                                href="{{ route('absensi.detail', $absen->id_absensi) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-warning"
                                                href="{{ route('absensi.edit', $absen->id_absensi) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="btn btn-danger" id="delete"
                                                href="{{ route('absensi.delete', $absen->id_absensi) }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <a class="btn btn-secondary"
                                                href="{{ route('pilih.unduhan', $absen->id_absensi) }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            @endif

                                            @if(auth('kepsek')->check())
                                            <a class="btn btn-primary"
                                                href="{{ route('absensi.detail', $absen->id_absensi) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-secondary"
                                                href="{{ route('pilih.unduhan', $absen->id_absensi) }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            @endif

                                        </div>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div><!-- End Default Card -->
    </div>
    @else
    <p>Silakan pilih mata pelajaran terlebih dahulu.</p>
    @endif

</section>

@endsection