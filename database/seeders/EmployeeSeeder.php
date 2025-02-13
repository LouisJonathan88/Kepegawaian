<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
            [
                'nama_lengkap' => 'John Doe',
                'nip' => 'P001',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'john.doe@example.com',
                'gaji' => 6000000,
                'department_id' => 1,
                'position_id' => 2
            ],
            [
                'nama_lengkap' => 'Jane Smith',
                'nip' => 'P002',
                'jenis_kelamin' => 'Perempuan',
                'email' => 'jane.smith@example.com',
                'gaji' => 8000000,
                'department_id' => 2,
                'position_id' => 3
            ]
        ];

        DB::table('employees')->insert($employees);
    }
}