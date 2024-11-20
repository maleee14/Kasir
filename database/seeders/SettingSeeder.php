<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'nama_toko' => 'Sembako Udin',
            'alamat' => 'Jalan Selalu Sehat No.69 Osaka, Jepang Selatan',
            'telepon' => '081258920543',
            'path_logo' => '.',
            'path_kartu_member' => '.',
            'tipe_nota' => 1,
            'diskon' => 5
        ]);
    }
}
