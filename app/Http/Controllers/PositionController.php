<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $positions = Position::with('department')
            ->withCount('employees')
            ->when($request->search, function($query, $search) {
                return $query->where('nama_jabatan', 'like', "%{$search}%")
                             ->orWhereHas('department', function($q) use ($search) {
                                 $q->where('nama_departemen', 'like', "%{$search}%");
                             });
            })
            ->paginate(10);

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // Bersihkan input gaji_pokok
        if ($request->has('gaji_pokok')) {
            $request->merge([
                'gaji_pokok' => $this->cleanCurrency($request->input('gaji_pokok'))
            ]);
        }

        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'gaji_pokok' => 'nullable|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        Position::create($validatedData);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);

        // Bersihkan input gaji_pokok
        if ($request->has('gaji_pokok')) {
            $request->merge([
                'gaji_pokok' => $this->cleanCurrency($request->input('gaji_pokok'))
            ]);
        }

        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'gaji_pokok' => 'nullable|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $position->update($validatedData);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui');
    }

    // Metode untuk membersihkan format mata uang
    private function cleanCurrency($value)
    {
        // Jika sudah numeric, kembalikan langsung
        if (is_numeric($value)) {
            return $value;
        }

        // Hapus 'Rp', spasi, dan titik
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        
        // Pastikan tidak kosong
        return $cleaned ?: 0;
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus');
    }
}