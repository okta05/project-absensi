@extends('tampilan.index_master')
@section('tampilan')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("dashboard")}}"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src=" 
                    
                    @if (Auth::guard('kepsek')->check())
                      {{asset('storage/'. $profileData->foto_kepsek)}}
                    @elseif (Auth::guard('admin')->check())
                      {{asset('storage/'. $profileData->foto)}}
                         @elseif (Auth::guard('kurikulum')->check())
                      {{asset('storage/'. $profileData->foto_kurikulum)}}
                         @elseif (Auth::guard('bk')->check())
                      {{asset('storage/'. $profileData->foto_bk)}}
                         @elseif (Auth::guard('wakel')->check())
                      {{asset('storage/'. $profileData->foto_wakel)}}
                         @elseif (Auth::guard('guru')->check())
                      {{asset('storage/'. $profileData->foto_guru)}}
                    @endif
                    " alt="Profile" class="rounded-circle">
                    <h2>{{ $profileData->nama ?? 'nama' }}</h2>
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
                                data-bs-target="#profile-overview">Profile</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{ $profileData->nama ?? 'Nama' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIP</div>
                                <div class="col-lg-9 col-md-8">{{ $profileData->nip ?? 'NIP' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{ $profileData->jns_kelamin ?? 'Jenis_kelamin' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">{{ $profileData->alamat ?? 'Alamat' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No Telpon</div>
                                <div class="col-lg-9 col-md-8">{{ $profileData->no_telp ?? 'No_Telpon' }}</div>
                            </div>

                            <div class="row col-lg-1">
                                <a href="{{route("profile.edit")}}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection