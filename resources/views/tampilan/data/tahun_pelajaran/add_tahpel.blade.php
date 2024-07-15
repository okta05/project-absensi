@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Tahun Pelajaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("tahpel.view")}}">Data Tahun Pelajaran</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Tahun Pelajaran</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Tahun Pelajaran</h5>

            <!-- General Form Elements -->
            <form>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan tahun pelajaran">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('tahpel.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection