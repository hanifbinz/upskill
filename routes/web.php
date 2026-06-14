<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SpvController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    // Jalur Karyawan
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard']);
    Route::get('/employee/questionnaire', [EmployeeController::class, 'questionnaire']);
    Route::post('/employee/questionnaire', [EmployeeController::class, 'store']);

    // Jalur SPV
    Route::get('/spv/dashboard', [SpvController::class, 'dashboard']);
    Route::get('/spv/review/{id}', [SpvController::class, 'review']);
    Route::post('/spv/review/{id}', [SpvController::class, 'update']);
    
    // Jalur Tambah User
    Route::get('/spv/users/create', [SpvController::class, 'createUser']);
    Route::post('/spv/users/create', [SpvController::class, 'storeUser']);

    // RUTE BARU: Laporan (Report)
    Route::get('/spv/report', [SpvController::class, 'report']);
});