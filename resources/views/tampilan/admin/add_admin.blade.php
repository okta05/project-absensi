@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.view")}}">Data Admin</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Admin</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Admin</h5>

            <!-- General Form Elements -->
            <form>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nis" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan NIP">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                value="laki-laki">
                            <label class="form-check-label" for="laki-laki">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                value="perempuan">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan alamat">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Masukkan nomor telepon">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nm_ortu" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" placeholder="Masukkan username">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_tel_ortu" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Masukkan password">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('admin.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection