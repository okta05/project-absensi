@extends('tampilan.index_master')

@section('tampilan')

<section class="section dashboard">
    <div class="pagetitle">
        <h1>Lihat Absensi Perbulan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('mapel.absensi') }}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a href="{{ session('previous_url', route('mapel.absensi')) }}">Absensi</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Lihat Absensi</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <form id="filterForm" action="{{ route('tampilkan_absensi_perbulan') }}" method="GET"
                            class="d-flex align-items-center">
                            <!-- Dropdown Bulan -->
                            <select class="form-select me-2" name="bulan" style="width: 300px;" required
                                onchange="document.getElementById('filterForm').submit();">
                                <option value="" disabled selected>Pilih Bulan</option>
                                @foreach($months as $month)
                                <option value="{{ $month->year }}-{{ str_pad($month->month, 2, '0', STR_PAD_LEFT) }}"
                                    @if($selected_month==$month->year.'-'.str_pad($month->month, 2, '0', STR_PAD_LEFT))
                                    selected @endif>
                                    {{ \Carbon\Carbon::createFromFormat('m', $month->month)->translatedFormat('F') }}
                                    {{ $month->year }}
                                </option>
                                @endforeach
                            </select>

                            <!-- Hidden input untuk id_mapel -->
                            <input type="hidden" name="id_mapel" value="{{ $mapel->id_mapel }}">
                        </form>

                        <!-- Tombol Unduh Absensi -->
                        @if($selected_month)
                        <a href="{{ route('unduh_absensi_perbulan', ['id_mapel' => $mapel->id_mapel, 'bulan' => $selected_month]) }}"
                            class="btn btn-primary ms-2">
                            <i class="bi bi-download"></i> Unduh Absensi
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tampilkan Data Absensi Jika Ada -->
            @if(!empty($absensi))
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>No Absen</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Status Kehadiran</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensi as $data)
                            <tr>
                                <td>{{ $data->siswa->no_absen }}</td>
                                <td>{{ $data->siswa->nama }}</td>
                                <td>{{ $data->siswa->nis }}</td>
                                <td>{{ $data->stts_kehadiran }}</td>
                                <td>{{ $data->catatan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="card-body mt-3">
                <p>Silakan pilih bulan untuk melihat data absensi.</p>
            </div>
            @endif
        </div><!-- End Default Card -->
    </div>
</section>

@endsection