@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Wali Kelas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Wali Kelas</a></li>
    </nav>
</div><!-- End Page Title -->

<div class="row">
    <!-- Button to add ticket -->
    <div class="col-12 d-flex justify-content-start">
        <a href="{{route("wakel.add")}}" class="btn btn-success">
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
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ($allDataWakel as $key => $wakel )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$wakel->nama}}</td>
                                    <td>{{$wakel->nip}}</td>
                                    <td>{{$wakel->jns_kelamin}}</td>
                                    <td>{{$wakel->alamat}}</td>
                                    <td>{{$wakel->no_telp}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary" href="{{ route('wakel.detail', $wakel->id_wakel) }}"><i
                                                    class="bi bi-eye"></i></a>

                                            <a class="btn btn-warning" href="{{ route('wakel.edit', $wakel->id_wakel) }}"><i
                                                    class="bi bi-pencil-square"></i></a>

                                            <a class="btn btn-danger" id="delete" href="{{ route('wakel.delete', $wakel->id_wakel) }}"><i class="bi bi-trash"></i></a>
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