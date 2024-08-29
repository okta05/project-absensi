<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Absensi PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Detail Absensi</h1>
    <p>Mata Pelajaran: {{ $absensi->mapel->nm_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}</p>
    <p>Kode Mata Pelajaran: {{ $absensi->mapel->kd_mapel ?? 'Kode Tidak Ditemukan' }}</p>
    <p>Kelas: {{ $absensi->kelas->nm_kelas ?? 'Kelas Tidak Ditemukan' }}</p>
    <p>Guru: {{ $absensi->guru->nama ?? 'Guru Tidak Ditemukan' }}</p>
    <p>Tahun Pelajaran: {{ $absensi->tahpel->th_pelajaran ?? 'Tahun Pelajaran Tidak Ditemukan' }}</p>
    <p>Tanggal: {{ $absensi->tanggal }}</p>
    <p>Jam: {{ $absensi->jam }}</p>

    <table>
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
            @foreach ($siswas as $siswa)
            <tr>
                <td>{{ $siswa->no_absen }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>
                    @php
                        $detail = $absensiDetails->firstWhere('id_siswa', $siswa->id_siswa);
                    @endphp
                    {{ $detail->stts_kehadiran ?? 'Belum Terdaftar' }}
                </td>
                <td>
                    {{ $detail->catatan ?? 'Tidak Ada Catatan' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
