<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public function wakel()
    {
        return $this->belongsTo(Wakel::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
