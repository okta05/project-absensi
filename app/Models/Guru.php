<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class Guru extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $tabel = "gurus";
    protected $primaryKey = "id_guru";
   
    protected $fillable = [
        'nama',
        'nip',
        'jns_kelamin',
        'alamat',
        'no_telp',
        'foto',
        'email',
        'password',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $appends = [
        'profile_photo_url',
    ];

   
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_guru', 'id_guru');
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id_guru', 'id_guru');
    }
}