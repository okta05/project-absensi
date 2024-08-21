@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Detail Data Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("siswa.view")}}">Data Siswa</a></li>
            <li class="breadcrumb-item active"><a href="#">Detail Data Siswa</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">




        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('storage/'. $viewDataSiswa->foto)}}" alt="Profile" class="rounded-circle">
                    <h2>{{$viewDataSiswa->nama}}</h2>
                    <h3>{{$viewDataSiswa->kelas->nm_kelas}}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Detail</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Catatan</h5>
                            <p class="small fst-italic">{{$viewDataSiswa->catatan}}</p>

                            <h5 class="card-title">Detail Siswa</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->nama}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIS</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->nis}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kelas</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->kelas->nm_kelas}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tahun Masuk</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->th_masuk}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->tpt_lahir}}, {{$viewDataSiswa->tgl_lahir}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->jns_kelamin}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->alamat}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No Telpon</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->no_telp}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Orang Tua</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->nm_ortu}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Id Telegram Orang Tua</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataSiswa->id_tel_ortu}}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>



    </div>
</section>

@endsection