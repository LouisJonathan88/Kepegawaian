<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['nama_jabatan' => 'Manager', 'gaji_pokok' => 10000000, 'deskripsi' => 'Posisi manajerial'],
            ['nama_jabatan' => 'Staff', 'gaji_pokok' => 5000000, 'deskripsi' => 'Posisi staff'],
            ['nama_jabatan' => 'Supervisor', 'gaji_pokok' => 7500000, 'deskripsi' => 'Posisi pengawas']
        ];

        DB::table('positions')->insert($positions);
    }
}