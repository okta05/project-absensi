<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = "id_siswa";

    protected $fillable = [
        'nama',
        'nis',
        'id_kelas',
        'alamat',
        'jns_kelamin',
        'no_absen',
        'tgl_lahir',
        'tpt_lahir',
        'th_masuk',
        'catatan',
        'nm_ortu',
        'id_tel_ortu',
        'foto',
    ];

    // Definisikan relasi dan atribut lainnya jika perlu

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_siswa', 'id_siswa');
    }
}
