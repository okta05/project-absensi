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

            <form method="post" action="{{route('siswa.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="textNama" class="col-sm-2 col-form-label">Nama Siswa</label>
                    <div class="col-sm-10">
                        <input type="text" name="textNama" id="textNama" class="form-control"
                            placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textNIS" class="col-sm-2 col-form-label">NISN/NIS</label>
                    <div class="col-sm-10">
                        <input type="text" name="textNIS" id="textNIS" class="form-control" placeholder="Masukkan NIS">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_tpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" name="text_tpt_lahir" id="text_tpt_lahir" class="form-control"
                            placeholder="Masukkan tempat lahir">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" name="text_tgl_lahir" id="text_tgl_lahir" class="form-control"
                            placeholder="Masukkan tempat lahir">
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
                        <input type="text" class="form-control" name="textAlamat" id="textAlamat"
                            placeholder="Masukkan alamat">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_no_telp" class="col-sm-2 col-form-label">No. Telp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="text_no_telp" id="text_no_telp"
                            placeholder="Masukkan nomor telepon">
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="text_th_masuk" class="col-sm-2 col-form-label">Tahun Masuk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="text_th_masuk" id="text_th_masuk"
                            placeholder="Masukkan tahun masuk">
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="text_no_absen" class="col-sm-2 col-form-label">Masukan No Absen</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="text_no_absen" id="text_no_absen"
                            placeholder="Masukkan no absen">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="textKelas" id="textKelas" aria-label="Default select example">
                            <option selected disabled>pilih kelas</option>

                            @foreach($idKelas as $kelas)
                                <option value="{{$kelas->id_kelas}}">{{$kelas->nm_kelas}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_siswa" class="col-sm-2 col-form-label">Upload Foto</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="foto_siswa" id="foto_siswa">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_siswa" class="col-sm-2 col-form-label">Preview</label>
                    <div class="col-sm-10">
                        <img id="previewFoto_siswa" src="#" alt="Preview Foto" style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textCatatan" class="col-sm-2 col-form-label">Catatan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="textCatatan" id="textCatatan" style="height: 100px"
                            placeholder="Masukan catatan (jika ada)"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_nm_ortu" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" name="text_nm_ortu" id="text_nm_ortu" class="form-control"
                            placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_id_tel_ortu" class="col-sm-2 col-form-label">Id Telegram Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" name="text_id_tel_ortu" id="text_id_tel_ortu" class="form-control"
                            placeholder="Masukkan id telegram">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('siswa.view')}}" class="btn btn-success">Batal</a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection