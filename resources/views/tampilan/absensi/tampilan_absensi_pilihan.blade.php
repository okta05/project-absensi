<!DOCTYPE html>
<html>

<head>
    <title>Detail Absensi</title>
    <style>
    /* Tambahkan CSS untuk format PDF jika diperlukan */
    </style>
</head>

<body>
    <h1>Detail Absensi</h1>
    <!-- Tambahkan konten yang ingin ditampilkan di PDF -->
    <table>
        <!-- Table header dan data -->
        <tr>
            <th>No Absen</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Status Kehadiran</th>
            <th>Catatan</th>
        </tr>
        @foreach ($siswas as $siswa)
        <tr>
            <td>{{ $siswa->no_absen }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>
                @foreach ($absensiDetails as $detail)
                @if ($detail->id_siswa == $siswa->id_siswa)
                {{ $detail->stts_kehadiran }}
                @endif
                @endforeach
            </td>
            <td>
                @foreach ($absensiDetails as $detail)
                @if ($detail->id_siswa == $siswa->id_siswa)
                {{ $detail->catatan }}
                @endif
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>