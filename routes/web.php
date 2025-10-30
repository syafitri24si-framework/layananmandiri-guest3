<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('dashboard');
// });

// ==================== AUTH ROUTES ====================
// DASHBOARD
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// LOGIN
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.store');



// ==================== PROTECTED DASHBOARD ====================
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
