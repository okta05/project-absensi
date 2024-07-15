@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Kelas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("kelas.view")}}">Data Kelas</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Kelas</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Kelas</h5>

            <!-- General Form Elements -->
            <form>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan nama kelas>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tingkat</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>Pilih Tingkat</option>
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
                        <a href="{{route('kelas.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection