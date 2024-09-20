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
                <li class="breadcrumb-item"><a href="{{ session('previous_url', route('mapel.absensi')) }}">Absensi</a>
                </li>
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
                        <form action="{{route('unduh_absensi.persemester')}}" method="get"
                            class="d-flex align-items-center">

                            <!-- Hidden field untuk id_mapel -->
                            <input type="hidden" name="id_mapel" value="{{ $mapel_id }}">

                            <!-- Dropdown Semester -->
                            <select class="form-select me-2" name="semester" style="width: 300px;" required>
                                @if($semester)
                                <option value="{{ $semester }}">{{ $semester }}</option>
                                @else
                                <option value="">Semester tidak tersedia</option>
                                @endif
                            </select>
                            <!-- Tombol Unduh -->
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body mt-3">
                <div class="table-responsive">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <!-- Tampilkan tanggal hanya sekali per tanggal -->

                                <td>

                                </td>

                                <td></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- End Default Card -->
    </div>
</section>

@endsection