<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahpel extends Model
{
    use HasFactory;

    protected $primaryKey = "id_tahpel";
    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_tahpel', 'id_tahpel');
    }
}
