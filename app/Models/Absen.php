<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';

    protected $fillable = [
        'user_id',
        'lokasi_magang_id',
        'tanggal',
        'lat_masuk',
        'lng_masuk',
        'jam_masuk',
        'lat_pulang',
        'lng_pulang',
        'jam_pulang',
        'foto_masuk',
        'foto_pulang',
        'status',
        'keterangan',
        'jenis',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
