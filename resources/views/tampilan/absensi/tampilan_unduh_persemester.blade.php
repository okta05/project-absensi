<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Semester {{ $semester }}</title>
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
    }

    th {
        background-color: #f2f2f2;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <h2>Laporan Absensi Semester {{ $semester }}</h2>

    <h3>Jumlah Status Kehadiran</h3>
    <table>
        <thead>
            <tr>
                <th>Status Kehadiran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiranPerSemester as $status => $jumlah)
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
            $siswa = $absensiSiswa->first()->siswa;
            $jumlahHadir = $absensiSiswa->filter(function ($item) {
            return $item->stts_kehadiran === 'Hadir';
            })->count();
            $jumlahBelumHadir = $absensiSiswa->filter(function ($item) {
            return $item->stts_kehadiran === 'Belum Hadir';
            })->count();
            $jumlahIjin = $absensiSiswa->filter(function ($item) {
            return $item->stts_kehadiran === 'Ijin';
            })->count();
            $jumlahSakit = $absensiSiswa->filter(function ($item) {
            return $item->stts_kehadiran === 'Sakit';
            })->count();
            $jumlahAlpa = $absensiSiswa->filter(function ($item) {
            return $item->stts_kehadiran === 'Alpa';
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