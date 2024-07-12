@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Ubah Data Mata Pelajaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("mapel.view")}}">Data Mata Pelajaran</a></li>
            <li class="breadcrumb-item active"><a href="#">Ubah Data Mata Pelajaran</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Ubah Mata Pelajaran</h5>

            <!-- General Form Elements -->
            <form>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tingkat</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>Pilih Tingkat Telas</option>
                            <option value="1">7</option>
                            <option value="2">8</option>
                            <option value="2">8</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Wali Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>pilih Wali Kelas</option>
                            <option value="1">Wali Kelas 1</option>
                            <option value="2">Wali Kelas 2</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('mapel.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection