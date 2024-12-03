<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan beberapa lokasi magang
        DB::table('lokasi_magang')->insert([
            [
                'name' => 'Diskominfo Kota Tanjungpinang',
                'alamat' => 'Senggarang, Kec. Tj. Pinang Kota, Kota Tanjung Pinang, Kepulauan Riau',
                'latitude' => '0.9622228952444394',
                'longitude' => '104.44828211587932',
            ],
            [
                'name' => 'Diskominfo Provinsi Kepulauan Riau',
                'alamat' => 'Dompak, Kec. Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau',
                'latitude' => '0.8753978370269331',
                'longitude' => '104.44380044152642',
            ],
            
        ]);
    }
}
