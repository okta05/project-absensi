<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi {{ $semester }}</title>
</head>
<body>
    <h2>Laporan Absensi {{ $semester }}</h2>
    @foreach($absensi as $siswa_id => $absensiSiswa)
        <h3>Nama Siswa: {{ $absensiSiswa->first()->siswa->nama }}</h3>
        <ul>
            @foreach($absensiSiswa as $absen)
                <li>Tanggal: {{ $absen->tanggal }}, Mapel: {{ $absen->mapel->nama }}, Status: {{ $absen->stts_kehadiran }}, Catatan: {{ $absen->catatan }}</li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>
