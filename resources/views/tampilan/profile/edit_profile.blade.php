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
        <div class="col-xl-8">
            <!-- Profile Edit Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="textNama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textNama" type="text" class="form-control" id="textNama"
                            value="{{ $profileData->nama }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textNIP" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textNIP" type="text" class="form-control" id="textNIP"
                            value="{{ $profileData->nip }}">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-md-4 col-lg-3">Jenis Kelamin</legend>
                    <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_jns_kelamin" value="Laki-laki"
                                id="text_jns_kelamin1" @if($profileData->jns_kelamin == 'Laki-laki') checked
                            @endif>
                            <label class="form-check-label" for="text_jns_kelamin1">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="text_jns_kelamin" value="Perempuan"
                                id="text_jns_kelamin2" @if($profileData->jns_kelamin == 'Perempuan') checked
                            @endif>
                            <label class="form-check-label" for="text_jns_kelamin2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <label for="textAlamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textAlamat" type="text" class="form-control" id="textAlamat"
                            value="{{ $profileData->alamat }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_no_telp" class="col-md-4 col-lg-3 col-form-label">No Telpon</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="text_no_telp" type="number" class="form-control" id="text_no_telp"
                            value="{{ $profileData->no_telp }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_profile" class="col-md-4 col-lg-3 col-form-label">Upload Foto</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="foto_profile" type="file" class="form-control" id="foto_profile">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_profile" class="col-md-4 col-lg-3 col-form-label">Preview</label>
                    <div class="col-md-8 col-lg-9">
                        <img id="previewFoto_profile" src="{{ $profileData->$fotoColumn ? asset('storage/' . $profileData->$fotoColumn) : '#' }}" alt="Profile Photo"
                            style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email"
                            value="{{ $profileData->email }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form><!-- End Profile Edit Form -->
        </div>
    </div>
</section>

@endsection