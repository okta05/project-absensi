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
                <li class="breadcrumb-item"><a href="#">Pilih Data Absensi</a></li>
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
                                <div class="col-lg-8 col-md-7">{{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                    <span class="text-nowrap">Guru</span>
                                    <span class="text-nowrap">:</span>
                                </div>
                                <div class="col-lg-8 col-md-7">{{ $mapel->guru->nama ?? 'Guru Tidak Ditemukan' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <a href="{{ route('add.absensi') }}" class="btn btn-success">
                            <i class="bi bi-journal-plus"></i> Tambah
                        </a>
                    </div>
                </div>

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
                                    <th>Jam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ( $allDataAbsensi as $key => $absen )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$absen->tanggal}}</td>
                                    <td>{{$absen->mapel->nm_mapel ?? 'tidak ditemukan'}}</td>
                                    <td>{{$absen->mapel->kd_mapel ?? 'tidak ditemukan'}}</td>
                                    <td>{{$absen->jam}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary" href="#">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-warning" href="#">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="btn btn-danger" id="delete" href="#">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
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