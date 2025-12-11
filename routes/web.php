<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasPersyaratanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\PermohonanSuratController;
use App\Http\Controllers\RiwayatStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});

// ==================== AUTH ROUTES ====================
// DASHBOARD
Route::resource('dashboard', DashboardController::class);
//Route Resource

Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::resource('auth', AuthController::class);

// ==================== BERKAS PERSYARATAN ROUTES ====================

// HAPUS SEMUA ROUTE BERKAS PERSYARATAN YANG LAMA
// DAN GANTI DENGAN INI SAJA:

// Route utama dengan resource

Route::group(['middleware' => ['checkislogin']], function () {

    Route::group(['middleware' => ['checkrole:Admin']], function () {
        Route::resource('user', UserController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('jenis_surat', JenisSuratController::class);
// Jenis Surat Routes - Tambahan khusus
        Route::get('/jenis_surat/{id}', [JenisSuratController::class, 'show'])->name('jenis_surat.show');
        Route::get('/jenis_surat/download/{id}', [JenisSuratController::class, 'downloadTemplate'])->name('jenis_surat.download_template');

        Route::resource('permohonan_surat', PermohonanSuratController::class);
        Route::resource('berkas_persyaratan', BerkasPersyaratanController::class);
        Route::resource('riwayat_status', RiwayatStatusController::class);

// Route khusus untuk create dengan parameter (optional)
        Route::get('/berkas_persyaratan/create/{permohonan_id?}', [BerkasPersyaratanController::class, 'create'])
            ->name('berkas_persyaratan.create.with_param');

// Route untuk download file
        Route::get('/berkas_persyaratan/download/{mediaId}', [BerkasPersyaratanController::class, 'downloadFile'])
            ->name('berkas_persyaratan.download');

// ==================== RIWAYAT STATUS ROUTES ====================

// Riwayat Status
        Route::get('/riwayat-status', [RiwayatStatusController::class, 'index'])
            ->name('riwayat_status.index');
        Route::post('/riwayat-status/{id}/upload', [RiwayatStatusController::class, 'upload'])
            ->name('riwayat_status.upload');

    });

    Route::group(['middleware' => ['checkrole:Admin,Warga']], function () {
        Route::resource('user', UserController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('warga', WargaController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('permohonan_surat', PermohonanSuratController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('berkas_persyaratan', BerkasPersyaratanController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('jenis_surat', JenisSuratController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('riwayat_status', RiwayatStatusController::class)->only(['index', 'show', 'create', 'store']);
        // Jenis Surat Routes - Tambahan khusus
        Route::get('/jenis_surat/{id}', [JenisSuratController::class, 'show'])->name('jenis_surat.show');
        Route::get('/jenis_surat/download/{id}', [JenisSuratController::class, 'downloadTemplate'])->name('jenis_surat.download_template');

        Route::resource('permohonan_surat', PermohonanSuratController::class);
        Route::resource('berkas_persyaratan', BerkasPersyaratanController::class);

// Route khusus untuk create dengan parameter (optional)
        Route::get('/berkas_persyaratan/create/{permohonan_id?}', [BerkasPersyaratanController::class, 'create'])
            ->name('berkas_persyaratan.create.with_param');

// Route untuk download file
        Route::get('/berkas_persyaratan/download/{mediaId}', [BerkasPersyaratanController::class, 'downloadFile'])
            ->name('berkas_persyaratan.download');
    });

});
