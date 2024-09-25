@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Kepala Sekolah</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Kepala Sekolah</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row mb-2">
    <div class="col-12 d-flex justify-content-start">
        <a href="{{route("kepsek.add")}}" class="btn btn-success">
            <i class="bi bi-person-plus"></i> Tambah
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
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ( $allDataKepsek as $key => $kepsek )

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$kepsek->nama}}</td>
                                    <td>{{$kepsek->nip}}</td>
                                    <td>{{$kepsek->alamat}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary"
                                                href="{{ route('kepsek.detail', $kepsek->id_kepsek) }}"><i
                                                    class="bi bi-eye"></i></a>

                                            <a class="btn btn-warning"
                                                href="{{ route('kepsek.edit', $kepsek->id_kepsek) }}"><i
                                                    class="bi bi-pencil-square"></i></a>

                                            <a class="btn btn-danger" id="delete"
                                                href="{{ route('kepsek.delete', $kepsek->id_kepsek) }}">
                                                <i class="bi bi-trash"></i></a>
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