<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('login');
        }

        // Total statistik
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();
        $averageSalary = Employee::avg('gaji');
        $totalSalary = Employee::sum('gaji');

        // Data untuk pie chart pegawai per departemen
        $employeesByDepartment = Department::withCount('employees')
            ->get()
            ->map(function ($department) {
                return [
                    'nama_departemen' => $department->nama_departemen,
                    'total_pegawai' => $department->employees_count
                ];
            });

        // Data untuk bar chart gaji per departemen
        $salaryByDepartment = Department::select('nama_departemen')
            ->leftJoin('employees', 'departments.id', '=', 'employees.department_id')
            ->groupBy('nama_departemen')
            ->select(
                'nama_departemen', 
                DB::raw('AVG(gaji) as rata_rata_gaji'),
                DB::raw('COUNT(employees.id) as total_pegawai')
            )
            ->get()
            ->map(function ($department) {
                return [
                    'nama_departemen' => $department->nama_departemen,
                    'rata_rata_gaji' => $department->rata_rata_gaji ?? 0,
                    'total_pegawai' => $department->total_pegawai
                ];
            });

        return view('dashboard.index', [
            'totalEmployees' => $totalEmployees,
            'totalDepartments' => $totalDepartments,
            'totalPositions' => $totalPositions,
            'averageSalary' => $averageSalary,
            'totalSalary' => $totalSalary,
            'employeesByDepartment' => $employeesByDepartment,
            'salaryByDepartment' => $salaryByDepartment
        ]);
    }
}