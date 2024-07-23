@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Detail Data Kepala Sekolah</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("guru.view")}}">Data Guru</a></li>
            <li class="breadcrumb-item active"><a href="#">Detail Data Guru</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('storage/'. $viewDataGuru->foto_guru)}}" alt="Profile" class="rounded-circle">
                    <h2>{{$viewDataGuru->nama}}</h2>
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

                            <h5 class="card-title">Detail Guru</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataGuru->nama}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIP</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataGuru->nip}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataGuru->jns_kelamin}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataGuru->alamat}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No Telpon</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataGuru->no_telp}}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection