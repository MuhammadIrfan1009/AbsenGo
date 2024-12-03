<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor_induk',
        'foto_profil',
        'sekolah_id',
        'jurusan',
        'lokasi_magang_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function lokasi_magang()
    {
        return $this->belongsTo(LokasiMagang::class);
    }

    public function tokenExpired()
    {
        $token = $this->tokens->last();
        if (!$token) {
            return true;
        }

        $expiresAt = Carbon::parse($token->expires_at);
        return $expiresAt->isPast();
    }
}
