<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'nama_lengkap', 
        'nip', 
        'jenis_kelamin', 
        'email', 
        'department_id', 
        'position_id', 
        'gaji'
    ];

    // Relasi dengan Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relasi dengan Position
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}