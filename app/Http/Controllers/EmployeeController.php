<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['department', 'position']);

    // Pencarian berdasarkan berbagai kriteria
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('nama_lengkap', 'LIKE', "%{$searchTerm}%")
              ->orWhere('nip', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('department', function($dept) use ($searchTerm) {
                  $dept->where('nama_departemen', 'LIKE', "%{$searchTerm}%");
              })
              ->orWhereHas('position', function($pos) use ($searchTerm) {
                  $pos->where('nama_jabatan', 'LIKE', "%{$searchTerm}%");
              });
        });
    }

    $employees = $query->paginate(10);
    return view('employees.index', compact('employees'));
}
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'nip' => 'required|unique:employees',
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'email' => 'required|email|unique:employees',
        'department_id' => 'required|exists:departments,id',
        'position_id' => 'required|exists:positions,id',
        'gaji' => 'required|numeric'
    ]);

    // Bersihkan format gaji
    $validatedData['gaji'] = str_replace(['Rp', ' ', '.'], '', $validatedData['gaji']);

    Employee::create($validatedData);
    return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan');
}

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $validatedData = $request->validate([
        'nip' => 'required|unique:employees,nip,'.$id,
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'email' => 'required|email|unique:employees,email,'.$id,
        'department_id' => 'required|exists:departments,id',
        'position_id' => 'required|exists:positions,id',
        'gaji' => 'required|numeric'
    ]);

    // Bersihkan format gaji
    $validatedData['gaji'] = str_replace(['Rp', ' ', '.'], '', $validatedData['gaji']);

    $employee->update($validatedData);
    return redirect()->route('employees.index')->with('success', 'Pegawai berhasil diperbarui');
}
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        
    return view('employees.edit', compact('employee', 'departments', 'positions'));
}
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus');
    }
    public function detail($id)
    {
        $employee = Employee::with(['department', 'position'])
        ->findOrFail($id);
        \Log::info('Employee Detail', [
        'id' => $employee->id,
        'nama' => $employee->nama_lengkap,
        'jenis_kelamin' => $employee->jenis_kelamin
    ]);
    return response()->json($employee);
}
}