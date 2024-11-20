<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Saya Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'level' => 1
        ]);
    }
}
