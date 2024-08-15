<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelas';

    public function wakel()
    {
        return $this->belongsTo(Wakel::class, 'id_wakel');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
