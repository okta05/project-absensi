<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Bulan {{ $monthName }} Tahun {{ $tahun }}</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .header-table {
        margin-bottom: 0;
    }
    </style>
</head>

<body>
    <h2>Laporan Absensi Bulan {{ $monthName }} Tahun {{ $tahun }}</h2>

    <h3>Informasi Mata Pelajaran</h3>
    <table class="header-table">
        <thead>
            <tr>
                <th>Nama Mata Pelajaran</th>
                <th>Kode Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Nama Guru</th>
                <th>Semester</th>
                <th>Tahun Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $mapelData['nama_mapel'] ?? 'N/A' }}</td>
                <td>{{ $mapelData['kode_mapel'] ?? 'N/A' }}</td>
                <td>{{ $mapelData['kelas'] ?? 'N/A' }}</td>
                <td>{{ $mapelData['guru'] ?? 'N/A' }}</td>
                <td>{{ $mapelData['semester'] ?? 'N/A' }}</td>
                <td>{{ $mapelData['tahun_pelajaran'] ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Jumlah Status Kehadiran</h3>
    <table class="header-table">
        <thead>
            <tr>
                <th>Status Kehadiran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiranPerBulan as $status => $jumlah)
            <tr>
                <td>{{ $status }}</td>
                <td>{{ $jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Jumlah Kehadiran Per Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>Siswa</th>
                <th>NIS</th>
                <th>Hadir</th>
                <th>Belum Hadir</th>
                <th>Ijin</th>
                <th>Sakit</th>
                <th>Alpa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $siswa_id => $absensiSiswa)
            @php
            $siswa = $absensiSiswa->first()->first()->siswa;
            $jumlahHadir = $absensiSiswa->flatten()->filter(function($absensi) {
            return $absensi->stts_kehadiran === 'Hadir';
            })->count();
            $jumlahBelumHadir = $absensiSiswa->flatten()->filter(function($absensi) {
            return $absensi->stts_kehadiran === 'Belum Hadir';
            })->count();
            $jumlahIjin = $absensiSiswa->flatten()->filter(function($absensi) {
            return $absensi->stts_kehadiran === 'Ijin';
            })->count();
            $jumlahSakit = $absensiSiswa->flatten()->filter(function($absensi) {
            return $absensi->stts_kehadiran === 'Sakit';
            })->count();
            $jumlahAlpa = $absensiSiswa->flatten()->filter(function($absensi) {
            return $absensi->stts_kehadiran === 'Alpa';
            })->count();
            @endphp
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $jumlahHadir }}</td>
                <td>{{ $jumlahBelumHadir }}</td>
                <td>{{ $jumlahIjin }}</td>
                <td>{{ $jumlahSakit }}</td>
                <td>{{ $jumlahAlpa }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>