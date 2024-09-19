@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route("mapel.absensi")}}">Pilih Mapel</a></li>
                <li class="breadcrumb-item active">Absensi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Form Filter -->
    <form action="{{ route('pilih_data.absensi') }}" method="GET">
        <input type="hidden" name="id_mapel" value="{{ $mapel->id_mapel ?? old('id_mapel') }}">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ request('tanggal', session('filter_tanggal')) }}">
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="submit" name="reset" value="true" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

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
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->nm_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kode Mata Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->kd_mapel ?? 'Kode Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kelas</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Guru</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->guru->nama ?? 'Guru Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Tahun Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $mapel->tahpel->th_pelajaran ?? 'Tahun Pelajaran Tidak Ditemukan' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Action Buttons -->
                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <a href="{{ route('add.absensi', ['id_mapel' => $mapel->id_mapel]) }}" class="btn btn-success me-2">
                            <i class="bi bi-journal-plus"></i> Tambah
                        </a>
                        <a href="{{ route('absensi.perbulan', ['id_mapel' => $mapel->id_mapel]) }}" class="btn btn-primary me-2">
                            <i class="bi bi-download"></i> Unduh Per Bulan
                        </a>
                        <a href="{{ route('absensi.persemester', ['id_mapel' => $mapel->id_mapel]) }}" class="btn btn-primary">
                            <i class="bi bi-download"></i> Unduh Per Semester
                        </a>
                    </div>
                </div>

                <!-- Display Filtered Absensi Data -->
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Jam</th>
                                    <th>Aksi</th>
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
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-primary" href="{{ route('absensi.detail', $absen->id_absensi) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-warning" href="{{ route('absensi.edit', $absen->id_absensi) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a class="btn btn-danger" id="delete" href="{{ route('absensi.delete', $absen->id_absensi) }}">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <a class="btn btn-secondary" href="{{ route('pilih.unduhan', $absen->id_absensi) }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
