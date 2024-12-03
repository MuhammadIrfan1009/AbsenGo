<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sekolah')->insert([
            ['name' => 'SMK Negeri 1 Tanjungpinang', 'alamat' => 'Jl. Pramuka, Tanjung Ayun Sakti, Bukit Bestari, Tanjung Pinang City, Riau Islands'],
            ['name' => 'SMK Negeri 2 Tanjungpinan', 'alamat' => 'Jl. Pramuka, Tj. Ayun Sakti, Kec. Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau'],
            ['name' => 'SMK Negeri 3 Tanjungpinan', 'alamat' => 'Kp. Bulang, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau'],
            ['name' => 'SMK Negeri 4 Tanjungpinan', 'alamat' => 'Jl. Nusantara No.KM.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau' ],
            ['name' => 'SMK Negeri 5 Tanjungpinan', 'alamat' => 'Kp. Bugis, Kec. Tj. Pinang Kota, Kota Tanjung Pinang, Kepulauan Riau'],
        ]);
    }
}
