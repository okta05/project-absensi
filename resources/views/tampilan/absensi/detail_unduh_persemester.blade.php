@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Detail Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('mapel.absensi') }}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel]) }}">Absensi</a></li>
                <li class="breadcrumb-item"><a href="{{session('previous_url', route('absensi.persemester'))}}">Unduh
                        Persemester</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Detail Unduh Persemester</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                                    {{ $absensi->mapel->nm_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kode Mata Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $absensi->mapel->kd_mapel ?? 'Kode Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Kelas</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $absensi->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Guru</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $absensi->guru->nama ?? 'Guru Tidak Ditemukan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Tahun Pelajaran</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $absensi->tahpel->th_pelajaran ?? 'Tahun Pelajaran Tidak Ditemukan' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row mb-3">
                    <label for="tanggal" class="col-lg-4 col-md-5 col-form-label">Tanggal</label>
                    <div class="col-lg-8 col-md-7">
                        <input type="text" name="tanggal" id="tanggal" class="form-control"
                            value="{{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jam" class="col-lg-4 col-md-5 col-form-label">Jam</label>
                    <div class="col-lg-8 col-md-7">
                        <input type="text" name="jam" id="jam" class="form-control" value="{{ $absensi->jam }}"
                            disabled>
                    </div>
                </div>

                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No Absen</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Status Kehadiran</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{ $siswa->no_absen }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>
                                        @foreach ($absensiDetails as $detail)
                                        @if ($detail->id_siswa == $siswa->id_siswa)
                                        {{ $detail->stts_kehadiran }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($absensiDetails as $detail)
                                        @if ($detail->id_siswa == $siswa->id_siswa)
                                        {{ $detail->catatan }}
                                        @endif
                                        @endforeach
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

</section>

@endsection