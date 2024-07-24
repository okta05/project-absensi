@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Mata Pelajaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("mapel.view")}}">Data Mata Pelajaran</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Mata Pelajaran</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Mata Pelajaran</h5>

            <!-- General Form Elements -->
            <form method="post" action="{{route('mapel.store')}}">
                @csrf

                <div class="row mb-3">
                    <label for="textNM_Mapel" class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="textNM_Mapel" id="textNM_Mapel"
                            placeholder="Masukkan mata pelajaran">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Guru</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="text_id_guru" id="text_id_guru"
                            aria-label="Default select example">
                            <option selected disabled>Pilih Guru</option>
                            <option value="Guru 1">Guru 1</option>
                            <option value="Guru 2">Guru 2</option>
                            <option value="Guru 3">Guru 3</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="text_id_tahpel" id="text_id_tahpel"
                            aria-label="Default select example">
                            <option selected disabled>Pilih tahun pelajaran</option>
                            <option value="2022/2023">2022/2023</option>
                            <option value="2023/2024">2023/2024</option>
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