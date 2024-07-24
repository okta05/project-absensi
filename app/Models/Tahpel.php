<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahpel extends Model
{
    use HasFactory;

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
