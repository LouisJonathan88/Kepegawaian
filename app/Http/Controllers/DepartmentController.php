<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Str;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::withCount('employees')
        ->when($request->search, function($query, $search) {
            return $query->where('nama_departemen', 'like', "%{$search}%")
            ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->paginate(10);
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_departemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);
    
        Department::create($validatedData);
    
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }
    
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $validatedData = $request->validate([
            'nama_departemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);
        
        $department->update($validatedData);
        return redirect()->route('departments.index')->with('success', 'Departemen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil dihapus');
    }
}