<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Per Semester</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    .header,
    .footer {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .info-table th,
    .info-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .info-table th {
        background-color: #f2f2f2;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .summary {
        margin-top: 20px;
    }

    .summary table {
        width: 100%;
        border-collapse: collapse;
    }

    .summary table th,
    .summary table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .summary table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Absensi Per Semester</h1>
        </div>

        <!-- Info Table -->
        <table class="info-table">
            <tr>
                <th>Mata Pelajaran</th>
                <td>{{ $mapel->nm_mapel }}</td>
            </tr>
            <tr>
                <th>Guru</th>
                <td>{{ $guru->nama }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $kelas->nm_kelas }}</td>
            </tr>
            <tr>
                <th>Tahun Pelajaran</th>
                <td>{{ $tahunPelajaran }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $semester }}</td>
            </tr>
        </table>

        <!-- Siswa Absensi Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No Absen</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Hadir</th>
                    <th>Belum Hadir</th>
                    <th>Ijin</th>
                    <th>Sakit</th>
                    <th>Alpa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaAbsensi as $index => $siswa)
                <tr>
                    <td>{{ $siswa['no_absen'] }}</td> <!-- Update kolom ini sesuai dengan data no absensi -->
                    <td>{{ $siswa['nama'] }}</td>
                    <td>{{ $siswa['nis'] }}</td>
                    <td>{{ $siswa['hadir'] }}</td>
                    <td>{{ $siswa['belum_hadir'] }}</td>
                    <td>{{ $siswa['izin'] }}</td>
                    <td>{{ $siswa['sakit'] }}</td>
                    <td>{{ $siswa['alpa'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Siswa Absensi Tanggal Table -->
        <!-- Siswa Absensi Tanggal Table -->
        <h2>Detail Kehadiran Siswa</h2>
        @foreach ($siswaAbsensiBulan as $bulan => $siswaPerBulan)
        <h3>Bulan: {{ $bulan }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Tanggal Hadir</th>
                    <th>Tanggal Belum Hadir</th>
                    <th>Tanggal Izin</th>
                    <th>Tanggal Sakit</th>
                    <th>Tanggal Alpa</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($siswaPerBulan))
                @foreach ($siswaPerBulan as $siswa)
                <tr>
                    <td>{{ $siswa['nama'] }}</td>
                    <td>{{ $siswa['nis'] }}</td>
                    <td>{{ implode(', ', array_map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('d'), $siswa['tanggal_hadir'])) }}
                    </td>
                    <td>{{ implode(', ', array_map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('d'), $siswa['tanggal_belum_hadir'])) }}
                    </td>
                    <td>{{ implode(', ', array_map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('d'), $siswa['tanggal_izin'])) }}
                    </td>
                    <td>{{ implode(', ', array_map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('d'), $siswa['tanggal_sakit'])) }}
                    </td>
                    <td>{{ implode(', ', array_map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('d'), $siswa['tanggal_alpa'])) }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">Tidak ada data untuk bulan ini.</td>
                </tr>
                @endif
            </tbody>
        </table>
        @endforeach



        <!-- Summary Table -->
        <div class="summary">
            <h2>Total Status Kehadiran</h2>
            <table>
                <tr>
                    <th>Total Hadir</th>
                    <td>{{ $totalHadir }}</td>
                </tr>
                <tr>
                    <th>Total Belum Hadir</th>
                    <td>{{ $totalBelumHadir }}</td>
                </tr>
                <tr>
                    <th>Total Ijin</th>
                    <td>{{ $totalIzin }}</td>
                </tr>
                <tr>
                    <th>Total Sakit</th>
                    <td>{{ $totalSakit }}</td>
                </tr>
                <tr>
                    <th>Total Alpa</th>
                    <td>{{ $totalAlpa }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>