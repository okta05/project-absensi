<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $primaryKey = "id_absensi";

    protected $fillable = [
        'id_mapel',
        'id_kelas',
        'id_siswa',
        'id_tahpel',
        'id_guru',
        'stts_kehadiran',
        'catatan',
    ];

    public function details()
    {
        return $this->hasMany(Absensi_Detail::class, 'id_absensi');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function tahpel()
    {
        return $this->belongsTo(Tahpel::class, 'id_tahpel', 'id_tahpel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}
