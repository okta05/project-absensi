@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Tambah Data Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("siswa.view")}}">Data Siswa</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Siswa</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Data Siswa</h5>

            <!-- General Form Elements -->
            <form>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Siswa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan NIS">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-sm-1 text-center">
                        <span>/</span>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="tanggalLahir">
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
                    <label for="alamat" class="col-sm-2 col-form-label">No. Telp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Masukkan nomor telepon">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Preview Foto</label>
                    <div class="col-sm-10">
                        <img id="previewFoto" src="#" alt="Preview Foto" style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" placeholder="Masukan catatan (jika ada)"></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="nm_ortu" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_tel_ortu" class="col-sm-2 col-form-label">Id Telegram Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Masukkan id telegram">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('siswa.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

</div>

@endsection