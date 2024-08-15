@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Ubah Data Kelas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("kelas.view")}}">Data Kelas</a></li>
            <li class="breadcrumb-item active"><a href="#">Ubah Data Kelas</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Ubah Kelas</h5>

            <!-- General Form Elements -->
            <form method="post" action="{{route('kelas.update', $editDataKelas->id_kelas)}}">
                @csrf

                <div class="row mb-3">
                    <label for="textNM_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$editDataKelas->nm_kelas}}" name="textNM_kelas" id="textNM_kelas"
                            placeholder="Masukkan nama kelas">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tingkat</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="textTingkat" id="textTingkat"
                            aria-label="Default select example">
                            <option selected disabled>Pilih Tingkat</option>
                            <option value="7" {{($editDataKelas->tingkat==="7"? "selected":"")}}>7</option>
                            <option value="8" {{($editDataKelas->tingkat=="8"? "selected":"")}}>8</option>
                            <option value="9" {{($editDataKelas->tingkat=="9"? "selected":"")}}>9</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Wali Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="textWakel" id="textWakel" aria-label="Default select example">
                            <option selected disabled>pilih Wali Kelas</option>

                            @foreach($wakels as $wakel)
                            <option value="{{$wakel->id_wakel}}"
                                {{$editDataKelas->id_wakel=="$wakel->id_wakel"? "selected":""}}>
                                {{$wakel->nama}}
                            </option>
                            @endforeach

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