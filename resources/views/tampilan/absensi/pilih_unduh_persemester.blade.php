@extends('tampilan.index_master')

@section('tampilan')

<section class="section dashboard">
    <div class="pagetitle">
        <h1>Unduh Per Semester</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('mapel.absensi') }}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('pilih_data.absensi', ['id_mapel' => $absensi->id_mapel]) }}">Absensi</a></li>
                <li class="breadcrumb-item"><a href="#">Unduh Per Semester</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <form action="{{ route('absensi.unduhPersemesterPDF') }}" method="post"
                            class="d-flex align-items-center">
                            @csrf
                            <!-- Dropdown Semester -->
                            <select class="form-select me-2" name="semester" style="width: 300px;" required>
                                <option value="" disabled selected>Pilih Semester</option>
                                @foreach($semesters as $semester)
                                <option value="{{ $semester->semester }}">{{ $semester->semester }}</option>
                                @endforeach
                            </select>
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