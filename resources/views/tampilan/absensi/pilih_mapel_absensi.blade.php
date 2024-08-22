@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Pilih Mata Pelajaran</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        @foreach($mapels as $mapel)
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
            <a href="{{ route('pilih_data.absensi', ['id_mapel' => $mapel->id_mapel]) }}" class="stretched-link"></a>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $mapel->nm_mapel }}</h5> <!-- Nama mata pelajaran -->
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-book-half"></i>
                        </div>
                    </div>
                    <h5 class="card-title">{{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}</h5>
                    <h5 class="card-title">{{ $mapel->guru->nama ?? 'Kelas Tidak Ditemukan' }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

@endsection