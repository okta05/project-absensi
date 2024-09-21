@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Pilih Mata Pelajaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Pilih Mata Pelajaran</a>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Form Filter -->
    <form action="{{ route('mapel.absensi') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="nama_mapel" class="form-control" placeholder="Nama Mapel"
                    value="{{ request('nama_mapel') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas"
                    value="{{ request('nama_kelas') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="nama_guru" class="form-control" placeholder="Nama Guru"
                    value="{{ request('nama_guru') }}">
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('mapel.absensi') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach($mapels as $mapel)
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <a href="{{ route('pilih_data.absensi', ['id_mapel' => $mapel->id_mapel]) }}"
                    class="stretched-link"></a>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $mapel->nm_mapel }}</h5> <!-- Nama mata pelajaran -->
                    <h5 class="card-title">{{ $mapel->semester }}</h5> <!-- Nama mata pelajaran -->
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-book-half"></i>
                        </div>
                    </div>
                    <h5 class="card-title">{{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}</h5>
                    <h5 class="card-title">{{ $mapel->guru->nama ?? 'Guru Tidak Ditemukan' }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

@endsection