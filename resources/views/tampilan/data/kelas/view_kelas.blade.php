@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Kelas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Kelas</a></li>
    </nav>
</div>
<!-- nnd Page Title -->

<div class="row mb-3">
    <!-- Button to add ticket -->
    <div class="col text-start">
        <a class="btn btn-success" href="{{ route('kelas.add') }}">
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
                                    <th>Kelas</th>
                                    <th>Tingkat</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ( $allDataKelas as $key => $kelas )

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$kelas->nm_kelas}}</td>
                                    <td>{{$kelas->tingkat}}</td>
                                    <td>{{$kelas->id_wakel}}</td>
                                    <td>
                                        <div class="dropdown">

                                            <a class="btn btn-warning" href="{{ route('kelas.edit') }}"><i
                                                    class="bi bi-pencil-square"></i></a>

                                            <a class="btn btn-danger" href="#"><i class="bi bi-trash"></i></a>
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