<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk Admin
Route::resource('admin', AdminController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk Departments
Route::resource('departments', DepartmentController::class);

// Route untuk Positions
Route::resource('positions', PositionController::class);

// Route untuk Employees
Route::resource('employees', EmployeeController::class);

Route::get('/employees/{id}/detail', [EmployeeController::class, 'detail'])->name('employees.detail');

Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');