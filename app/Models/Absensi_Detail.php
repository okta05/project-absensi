<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi_Detail extends Model
{
    use HasFactory;

    protected $table = 'absensi__details'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'id_absensi_detail';
    protected $fillable = [
        'id_absensi',
        'id_siswa',
        'stts_kehadiran',
        'catatan',
    ];

    // Relasi ke model Absensi
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi');
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
