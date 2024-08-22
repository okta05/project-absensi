@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Absensi</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row mb-2">
    <div class="col-12 d-flex justify-content-start">
        <a href="#" class="btn btn-success">
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
                                    <th>NIS</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                 
                                 
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <!-- Data siswa lainnya -->
                               
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