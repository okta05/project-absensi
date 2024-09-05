@extends('tampilan.index_master')
@section('tampilan')

<section class="section dashboard">

    <div class="pagetitle">
        <h1>Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('mapel.absensi') }}">Pilih Mapel</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('pilih_data.absensi', ['id_mapel' => $mapel->id_mapel]) }}">Absensi</a></li>
                <li class="breadcrumb-item"><a href="#">Tambah Absensi</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row mb-2">
        <div class="col-12 d-flex justify-content-start">
            <a href="{{ route('pilih_data.absensi', ['id_mapel' => $mapel->id_mapel]) }}" class="btn btn-success">
                <i class="bi bi-arrow-left-square"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card" style="height: auto; padding: 10px;">
            <div class="card-body">
                <!-- Form untuk menyimpan absensi -->
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $mapel->id_mapel }}">
                    <input type="hidden" name="nm_mapel" value="{{ $mapel->nm_mapel }}">
                    <input type="hidden" name="kd_mapel" value="{{ $mapel->kd_mapel }}">
                    <input type="hidden" name="id_kelas" value="{{ $mapel->kelas->id_kelas ?? '' }}">
                    <input type="hidden" name="id_guru" value="{{ $mapel->guru->id_guru ?? '' }}">
                    <input type="hidden" name="id_tahpel" value="{{ $mapel->tahpel->id_tahpel ?? '' }}">

                    <div class="col-8 border border-3 p-3 mt-3 rounded shadow-sm">
                        <div class="tab-content pt-1">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                        <span class="text-nowrap">Mata Pelajaran</span>
                                        <span class="text-nowrap">:</span>
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        {{ $mapel->nm_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                        <span class="text-nowrap">Kode Mata Pelajaran</span>
                                        <span class="text-nowrap">:</span>
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        {{ $mapel->kd_mapel ?? 'Kode Tidak Ditemukan' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                        <span class="text-nowrap">Kelas</span>
                                        <span class="text-nowrap">:</span>
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        {{ $mapel->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                        <span class="text-nowrap">Guru</span>
                                        <span class="text-nowrap">:</span>
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        {{ $mapel->guru->nama ?? 'Guru Tidak Ditemukan' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 d-flex justify-content-between">
                                        <span class="text-nowrap">Tahun Pelajaran</span>
                                        <span class="text-nowrap">:</span>
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        {{ $mapel->tahpel->th_pelajaran ?? 'Tahun Pelajaran Tidak Ditemukan' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Input Tanggal -->
                    <div class="row mb-3">
                        <label for="tanggal" class="col-lg-4 col-md-5 col-form-label">Tanggal</label>
                        <div class="col-lg-8 col-md-7">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <!-- Input Jam -->
                    <div class="row mb-3">
                        <label for="jam" class="col-lg-4 col-md-5 col-form-label">Jam</label>
                        <div class="col-lg-8 col-md-7">
                            <input type="time" name="jam" id="jam" class="form-control" required>
                        </div>
                    </div>

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
                                    @foreach ($siswas as $key => $siswa)
                                    <tr>
                                        <td>{{ $siswa->no_absen }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>
                                            <select name="stts_kehadiran[{{ $siswa->id_siswa }}]" class="form-select">
                                                <option selected disabled>Pilih Status Kehadiran</option>
                                                <option value="Belum Hadir">Belum Hadir</option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Ijin">Ijin</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Alpa">Alpa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="catatan[{{ $siswa->id_siswa }}]" class="form-control"
                                                rows="2" placeholder="Masukkan catatan"></textarea>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">
                                 Simpan
                            </button>
                        </div>
                    </div>
                </form>
                <!-- End Form -->

            </div>
        </div><!-- End Default Card -->
    </div>

</section>

@endsection