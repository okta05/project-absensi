@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Data Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item active"><a href="#">Data Siswa</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row mb-2">
    <div class="col-12 d-flex justify-content-start">
        <a href="{{route("siswa.add")}}" class="btn btn-success">
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
                                    <th>Kelas</th>
                                    <th>NIS</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data siswa ditampilkan di sini -->
                                @foreach ( $allDataSiswa as $key => $siswa )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$siswa->nama}}</td>
                                    <td>{{$siswa->kelas->nm_kelas ?? 'Tidak Ditemukan'}}</td>
                                    <td>{{$siswa->nis}}</td>
                                    <td>{{$siswa->alamat}}</td>
                                    <td>{{$siswa->jns_kelamin}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item text-primary"
                                                        href="{{route('siswa.detail', $siswa->id_siswa)}}">Detail</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-warning"
                                                        href="{{route('siswa.edit', $siswa->id_siswa)}}">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger"
                                                        href="{{route('siswa.delete', $siswa->id_siswa)}}"
                                                        id="delete">Hapus</a>
                                                </li>
                                            </ul>
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