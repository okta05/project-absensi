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
    <table>
        <thead>
            <tr>
                <th>Siswa</th>
                <th>NIS</th>
                @foreach($dates as $tanggal)
                <th>{{ $tanggal }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $siswa_id => $absensiSiswa)
            @php
            $siswa = $absensiSiswa->first()->siswa;
            @endphp
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nis }}</td>
                @foreach($dates as $tanggal)
                @php
                $absensiItem = $absensiSiswa->firstWhere('tanggal', $tanggal);
                $status = $absensiItem ? $absensiItem->stts_kehadiran : 'Tidak Hadir';
                @endphp
                <td>{{ $status }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
