<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiMagang extends Model
{
    use HasFactory;

    protected $table= 'lokasi_magang';
    
    protected $fillable = [
        'name',
        'alamat',
        'latitude',
        'longitude',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
