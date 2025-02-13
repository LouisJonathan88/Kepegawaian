<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['nama_departemen' => 'Teknologi Informasi', 'deskripsi' => 'Departemen yang menangani sistem dan teknologi informasi'],
            ['nama_departemen' => 'Keuangan', 'deskripsi' => 'Departemen yang menangani keuangan perusahaan'],
            ['nama_departemen' => 'Sumber Daya Manusia', 'deskripsi' => 'Departemen yang menangani manajemen kepegawaian']
        ];

        DB::table('departments')->insert($departments);
    }
}