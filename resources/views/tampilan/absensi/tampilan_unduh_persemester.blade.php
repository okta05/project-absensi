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
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
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
        .summary table th, .summary table td {
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
            <p>Mata Pelajaran: {{ $mapel->nm_mapel }}</p>
            <p>Guru: {{ $guru->nama }}</p>
            <p>Kelas: {{ $kelas->nm_kelas }}</p>
            <p>Tahun Pelajaran: {{ $tahunPelajaran }}</p>
            <p>Semester: {{ $semester }}</p>
        </div>
        
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
                @foreach ($siswaAbsensi as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa['nama'] }}</td>
                        <td>{{ $siswa['hadir'] }}</td>
                        <td>{{ $siswa['belum hadir'] }}</td>
                        <td>{{ $siswa['ijin'] }}</td>
                        <td>{{ $siswa['sakit'] }}</td>
                        <td>{{ $siswa['alpa'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
                    <td>{{ $totalIjin }}</td>
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
