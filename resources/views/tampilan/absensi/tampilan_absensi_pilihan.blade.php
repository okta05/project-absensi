<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Absensi</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
    }

    .header {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <h2>Detail Absensi</h2>
    <p>Mata Pelajaran: {{ $absensi->mapel->nm_mapel ?? 'Tidak Ditemukan' }}</p>
    <p>Kode Mata Pelajaran: {{ $absensi->mapel->kd_mapel ?? 'Tidak Ditemukan' }}</p>
    <p>Kelas: {{ $absensi->kelas->nm_kelas ?? 'Tidak Ditemukan' }}</p>
    <p>Guru: {{ $absensi->guru->nama ?? 'Tidak Ditemukan' }}</p>
    <p>Tahun Pelajaran: {{ $absensi->tahpel->th_pelajaran ?? 'Tidak Ditemukan' }}</p>
    <p>Tanggal: {{ $absensi->tanggal }}</p>
    <p>Jam: {{ $absensi->jam }}</p>

    <table>
        <thead>
            <tr class="header">
                <th>No Absen</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Status Kehadiran</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiDetails as $detail)
            <tr>
                <td>{{ $detail->siswa->no_absen ?? '-' }}</td>
                <td>{{ $detail->siswa->nama ?? '-' }}</td>
                <td>{{ $detail->siswa->nis ?? '-' }}</td>
                <td>{{ $detail->stts_kehadiran ?? '-'}}</td>
                <td>{{ $detail->catatan ?? '-'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>