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
            <form>

                <div class="row mb-3">
                    <label for="textNama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textNama" type="text" class="form-control" id="textNama" value="Kevin Anderson">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textNIP" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textNIP" type="text" class="form-control" id="textNIP" value="121313">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_jns_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="text_jns_kelamin" type="text" class="form-control" id="text_jns_kelamin" value="Lakin-Laki">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="textAlamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="textAlamat" type="text" class="form-control" id="textAlamat" value="Rogojampi">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text_no_telp" class="col-md-4 col-lg-3 col-form-label">No Telpon</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="text_no_telp" type="number" class="form-control" id="text_no_telp" value="028829831">
                    </div>
                </div>

                
                <div class="row mb-3">
                    <label for="foto_profile" class="col-md-4 col-lg-3 col-form-label">Upload Foto</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="foto_profile" type="file" class="form-control" id="foto_profile" value="028829831">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto_profile" class="col-md-4 col-lg-3 col-form-label">Preview</label>
                    <div class="col-md-8 col-lg-9">
                        <img id="previewFoto_profile" src="#" alt="Preview Foto" style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="k.anderson@example.com">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password"
                            value="k.anderson@example.com">
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