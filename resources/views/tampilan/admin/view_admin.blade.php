@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Admin</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row mb-2">
    <div class="col-12 d-flex justify-content-start">
        <a href="{{route("admin.add")}}" class="btn btn-success">
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
                        <table class="table datatable">
                            <thead class="table-primary">
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
                                 @foreach ( $allDataAdmin as $key => $admin )
                                 
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$admin->nama}}</td>
                                    <td>{{$admin->nip}}</td>
                                    <td>{{$admin->jns_kelamin}}</td>
                                    <td>{{$admin->alamat}}</td>
                                    <td>{{$admin->no_telp}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary" href="{{ route('admin.detail') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-warning" href="{{ route('admin.edit') }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="btn btn-danger" href="#">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Data siswa lainnya -->
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