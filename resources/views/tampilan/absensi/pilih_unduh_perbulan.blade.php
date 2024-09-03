@extends('tampilan.index_master')

@section('tampilan')

<section class="section dashboard">
    <div class="pagetitle">
        <h1>Unduh Perbulan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('mapel.absensi') }}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a href="{{ session('previous_url', route('mapel.absensi')) }}">Absensi</a></li>
                <li class="breadcrumb-item"><a href="#">Unduh Perbulan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <form action="#" method="GET" class="d-flex align-items-center">
                            <!-- Dropdown Bulan -->
                            <select class="form-select me-2" name="bulan" style="width: 300px;" required>
                                <option value="" disabled selected>Pilih Bulan</option>
                                @foreach($months as $month)
                                <option value="{{ $month->year }}-{{ str_pad($month->month, 2, '0', STR_PAD_LEFT) }}">
                                    {{ DateTime::createFromFormat('!m', $month->month)->format('F') }}
                                    {{ $month->year }}
                                </option>
                                @endforeach
                            </select>

                            <!-- Hidden input untuk id_mapel -->
                            <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">

                            <!-- Tombol Unduh -->
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End Default Card -->
    </div>
</section>

@endsection