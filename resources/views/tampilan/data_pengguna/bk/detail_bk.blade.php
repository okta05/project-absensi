@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Detail Data BK</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route("bk.view")}}">Data BK</a></li>
            <li class="breadcrumb-item active"><a href="#">Detail Data BK</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('storage/'. $viewDataBk->foto_bk)}}" alt="Profile" class="rounded-circle">
                    <h2>{{$viewDataBk->nama}}</h2>
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

                            <h5 class="card-title">Detail BK</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataBk->nama}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIP</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataBk->nip}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataBk->jns_kelamin}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataBk->alamat}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No Telpon</div>
                                <div class="col-lg-9 col-md-8">{{$viewDataBk->no_telp}}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection