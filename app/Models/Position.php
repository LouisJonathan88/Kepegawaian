<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['nama_jabatan', 'gaji_pokok', 'deskripsi', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
{
    return $this->hasMany(Employee::class);
}
}