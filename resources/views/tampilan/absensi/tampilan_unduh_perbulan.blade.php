<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Perbulan</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
    }

    .table,
    .info-table,
    .summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .info-table th,
    .summary-table th,
    .table td,
    .info-table td,
    .summary-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table th,
    .info-table th,
    .summary-table th {
        background-color: #f2f2f2;
    }

    .info-table {
        margin-bottom: 30px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Absensi Perbulan</h1>
            <h2>{{ $mapel->nm_mapel }}</h2>
            <p>Bulan: {{ DateTime::createFromFormat('!m', substr(request()->input('bulan'), 5, 2))->format('F') }}
                {{ substr(request()->input('bulan'), 0, 4) }}</p>
        </div>

        <!-- Tabel Informasi -->
        <h3>Informasi Mata Pelajaran dan Kelas</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Nama Guru</th>
                    <th>Kelas</th>
                    <th>Kode Mata Pelajaran</th>
                    <th>Semester</th>
                    <th>Tahun Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $guru->nama }}</td>
                    <td>{{ $kelas->nm_kelas }}</td>
                    <td>{{ $mapel->kd_mapel }}</td>
                    <td>{{ $semester }}</td>
                    <td>{{ $tahunPelajaran }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Absensi Siswa -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Hadir</th>
                    <th>Belum Hadir</th>
                    <th>Ijin</th>
                    <th>Sakit</th>
                    <th>Alpa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaAbsensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['hadir'] }}</td>
                    <td>{{ $item['belum hadir'] }}</td>
                    <td>{{ $item['ijin'] }}</td>
                    <td>{{ $item['sakit'] }}</td>
                    <td>{{ $item['alpa'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Total Kehadiran -->
        <h3>Total Kehadiran per Status:</h3>
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hadir</td>
                    <td>{{ $totalHadir }}</td>
                </tr>
                <tr>
                    <td>Belum Hadir</td>
                    <td>{{ $totalBelumHadir }}</td>
                </tr>
                <tr>
                    <td>Ijin</td>
                    <td>{{ $totalIjin }}</td>
                </tr>
                <tr>
                    <td>Sakit</td>
                    <td>{{ $totalSakit }}</td>
                </tr>
                <tr>
                    <td>Alpa</td>
                    <td>{{ $totalAlpa }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>