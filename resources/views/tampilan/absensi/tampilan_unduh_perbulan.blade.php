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

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table th {
        background-color: #f2f2f2;
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

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Status Kehadiran</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->stts_kehadiran }}</td>
                    <td>{{ $item->catatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>