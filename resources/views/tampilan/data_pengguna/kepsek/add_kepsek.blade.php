@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("kepsek.view")}}">Data Kepala Sekolah</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Kepala Sekolah</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Kepala Sekolah</h5>

            <!-- General Form Elements -->
            <form method="post" action="{{route('kepsek.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="textNama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="textNama" id="textNama" class="form-control"
                            placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textNIP" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" name="textNIP" id="textNIP" class="form-control" placeholder="Masukkan NIP">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_jns_kelamin" id="text_jns_kelamin"
                                value="Laki-laki">
                            <label class="form-check-label" for="text_jns_kelamin">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_jns_kelamin" id="text_jns_kelamin"
                                value="Perempuan">
                            <label class="form-check-label" for="text_jns_kelamin">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <label for="textAlamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="textAlamat" id="textAlamat" class="form-control"
                            placeholder="Masukkan alamat">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_no_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="number" name="text_no_telp" id="text_no_telp" class="form-control"
                            placeholder="Masukkan nomor telepon">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_kepsek" class="col-sm-2 col-form-label">Upload Foto</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="foto_kepsek" id="foto_kepsek">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_kepsek" class="col-sm-2 col-form-label">Preview</label>
                    <div class="col-sm-10">
                        <img id="previewFoto_kepsek" src="#" alt="Preview Foto" style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan username">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan password">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('kepsek.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection