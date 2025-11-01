<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;

 Route::get('/', function () {
   return view('pages.dashboard');
 });

// ==================== AUTH ROUTES ====================
// DASHBOARD

//Route Resource
Route::resource('user', UserController::class);
Route::resource('warga', WargaController::class);
Route::resource('auth', AuthController::class);
Route::resource('jenis_surat', JenisSuratController::class);
Route::resource('dashboard', DashboardController::class);





