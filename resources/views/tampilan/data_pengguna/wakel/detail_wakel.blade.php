@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Detail Data Wali Kelas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("wakel.view")}}">Data Wali Kelas</a></li>
            <li class="breadcrumb-item active"><a href="#">Detail Data Wali Kelas</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('storage/'. $viewDataWakel->foto_wakel)}}" alt="Profile" class="rounded-circle">
                    <h2>{{$viewDataWakel->nama}}</h2>
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

                            <h5 class="card-title">Detail Kurikulum</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataWakel->nama}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIP</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataWakel->nip}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataWakel->jns_kelamin}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataWakel->alamat}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No Telpon</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataWakel->no_telp}}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection