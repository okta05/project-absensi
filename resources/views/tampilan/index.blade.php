@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <h1>Dashboard</h1>

                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-people-fill"></i> {{ $siswaCount }}</h5>
                                    <p class="card-text">Data Siswa</p>
                                    <a href="{{route('siswa.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-secondary text-white">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-person-fill"></i> {{ $adminCount }}</h5>
                                    <p class="card-text">Data Admin</p>
                                    <a href="{{route('admin.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-person-fill"></i> {{ $kepsekCount }}</h5>
                                    <p class="card-text">Data Kepala Sekolah</p>
                                    <a href="{{route('kepsek.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-person-fill"></i> {{ $kurikulumCount }}</h5>
                                    <p class="card-text">Data Kurikulum</p>
                                    <a href="{{route('kurikulum.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-person-fill"></i> {{ $bkCount }}</h5>
                                    <p class="card-text">Data BK</p>
                                    <a href="{{route('bk.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-people-fill"></i> {{ $wakelCount }}</h5>
                                    <p class="card-text">Data Wali Kelas</p>
                                    <a href="{{route('wakel.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-secondary text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-people-fill"></i> {{ $guruCount }}</h5>
                                    <p class="card-text">Data Guru</p>
                                    <a href="{{route('guru.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-door-open-fill"></i> {{ $kelasCount }}</h5>
                                    <p class="card-text">Data Kelas</p>
                                    <a href="{{route('kelas.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-book-fill"></i> {{ $mapelCount }}</h5>
                                    <p class="card-text">Data Mata Pelajaran</p>
                                    <a href="{{route('mapel.view')}}" class="btn btn-light">Lihat detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection