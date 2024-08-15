@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Mata Pelajaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Mata Pelajaran</a></li>
    </nav>
</div>
<!-- nnd Page Title -->

<div class="row mb-3">
    <!-- Button to add ticket -->
    <div class="col text-start">
        <a class="btn btn-success" href="{{ route('mapel.add') }}">
            <i class="bi bi-plus-square"></i>
        </a>
    </div>
</div>

<section class="section">
    <div class="container mt-4">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pejaran</th>
                                    <th>Guru</th>
                                    <th>Tahun Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ( $allDataMapel as $key => $mapel )

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$mapel->nm_mapel}}</td>
                                    <td>{{$mapel->guru->nama ?? 'Tidak Ditemukan'}}</td>
                                    <td>{{$mapel->id_th_pelajaran}}</td>
                                    <td>
                                        <div class="dropdown">

                                            <a class="btn btn-warning" href="{{ route('mapel.edit', $mapel->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>

                                            <a class="btn btn-danger" id="delete" href="{{ route('mapel.delete', $mapel->id) }}"><i class="bi bi-trash"></i></a>
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
        </div>
    </div>
</section>

@endsection