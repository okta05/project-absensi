@extends('tampilan.index_master')

@section('tampilan')

<div class="pagetitle">
    <h1>Data Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
            </li>
            <li class="breadcrumb-item active">Data Siswa</li>
        </ol>
    </nav>
</div>

@if(auth('admin')->check())
<div class="row mb-2">
    <div class="col-12 d-flex justify-content-start">
        <a href="{{ route('siswa.add') }}" class="btn btn-success">
            <i class="bi bi-person-plus"></i> Tambah
        </a>

        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data" class="ms-3">
            @csrf
            <input type="file" name="file" class="form-control d-inline" style="width: auto;">
            <button type="submit" class="btn btn-primary ms-2">Import Excel</button>
        </form>
    </div>
</div>
@endif

<!-- Form Filter -->
<div class="row mb-4">
    <div class="col-12">
        <form action="{{ route('siswa.view') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="nama" class="form-control" placeholder="Cari Nama"
                    value="{{ request('nama') }}">
            </div>
            <div class="col-md-3">
                <select name="kelas" class="form-select">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id_kelas }}"
                        {{ request('kelas') == $kelasItem->id_kelas ? 'selected' : '' }}>
                        {{ $kelasItem->nm_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="jns_kelamin" class="form-select">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="Laki-laki" {{ request('jns_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ request('jns_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('siswa.view') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </form>
    </div>
</div>

<section class="section">
    <div class="container mt-4">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Absen</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>NISN/NIS</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allDataSiswa as $key => $siswa)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $siswa->no_absen }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->kelas->nm_kelas ?? 'Tidak Ditemukan' }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    <td>{{ $siswa->jns_kelamin }}</td>
                                    <td>
                                        @if(
                                        auth('admin')->check() || auth('kepsek')->check() ||
                                        auth('kurikulum')->check() || auth('bk')->check() || auth('wakel')->check() ||
                                        auth('guru')->check()
                                        )
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                @if(auth('admin')->check())
                                                <li><a class="dropdown-item text-primary"
                                                        href="{{ route('siswa.detail', $siswa->id_siswa) }}">Detail</a>
                                                </li>
                                                <li><a class="dropdown-item text-warning"
                                                        href="{{ route('siswa.edit', $siswa->id_siswa) }}">Edit</a></li>
                                                <li><a class="dropdown-item text-danger"
                                                        href="{{ route('siswa.delete', $siswa->id_siswa) }}"
                                                        id="delete">Hapus</a></li>
                                                @endif

                                                @if(
                                                auth('kepsek')->check() || auth('kurikulum')->check() ||
                                                auth('bk')->check() || auth('wakel')->check() || auth('guru')->check()
                                                )
                                                <li><a class="dropdown-item text-primary"
                                                        href="{{ route('siswa.detail', $siswa->id_siswa) }}">Detail</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection