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
    </div>

    <div class="row align-items-top">
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-12 d-flex justify-content-start">
                        <form action="{{ route('unduh_absensi.persemester') }}" method="get"
                            class="d-flex align-items-center">
                            <input type="hidden" name="id_mapel" value="{{ $mapel_id }}">
                            <select class="form-select me-2" name="semester" style="width: 300px;" required>
                                <option value="{{ $semester }}">{{ $semester }}</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Total Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensi as $data)
                            <tr>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->jam }}</td>
                                <td>{{ $data->total_siswa }}</td>
                                <td>
                                    @php
                                    // Get the first id_absensi for this group
                                    $id_absensi = $absensiIds->where('tanggal', $data->tanggal)->where('jam',
                                    $data->jam)->first()->id_absensi ?? null;
                                    @endphp
                                    <a href="{{ route('absensi.detail', ['id' => $id_absensi]) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @if($absensi->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data absensi untuk semester ini.</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection