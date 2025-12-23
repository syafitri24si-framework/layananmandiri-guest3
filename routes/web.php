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

// ==================== PUBLIC ROUTES ====================
// Halaman utama (home)
Route::get('/', function () {
    return view('pages.home.dashboard');
})->name('home');

// Halaman-halaman publik lainnya
Route::get('/about', function () {
    return view('pages.home.about');
})->name('about');

Route::get('/layanan', function () {
    return view('pages.home.layanan');
})->name('layanan');

Route::get('/contact', function () {
    return view('pages.home.contact');
})->name('contact');

Route::get('/fitur-upload', function () {
    return view('pages.home.fitur-upload');
})->name('fitur.upload');

Route::get('/pengembang', function () {
    return view('pages.home.pengembang');
})->name('pengembang');

// ==================== DASHBOARD ROUTE ====================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==================== AUTH ROUTES ====================
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::resource('auth', AuthController::class);

// ==================== ROUTES DENGAN MIDDLEWARE ====================
Route::group(['middleware' => ['checkislogin']], function () {

    Route::group(['middleware' => ['checkrole:Admin']], function () {
        Route::resource('user', UserController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('jenis_surat', JenisSuratController::class);
        Route::get('/jenis_surat/{id}', [JenisSuratController::class, 'show'])->name('jenis_surat.show');
        Route::get('/jenis_surat/download/{id}', [JenisSuratController::class, 'downloadTemplate'])->name('jenis_surat.download_template');

        Route::resource('permohonan_surat', PermohonanSuratController::class);
        Route::resource('berkas_persyaratan', BerkasPersyaratanController::class);
        Route::resource('riwayat_status', RiwayatStatusController::class);

        Route::get('/berkas_persyaratan/create/{permohonan_id?}', [BerkasPersyaratanController::class, 'create'])
            ->name('berkas_persyaratan.create.with_param');

        Route::get('/berkas_persyaratan/download/{mediaId}', [BerkasPersyaratanController::class, 'downloadFile'])
            ->name('berkas_persyaratan.download');

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

        Route::get('/jenis_surat/{id}', [JenisSuratController::class, 'show'])->name('jenis_surat.show');
        Route::get('/jenis_surat/download/{id}', [JenisSuratController::class, 'downloadTemplate'])->name('jenis_surat.download_template');

        Route::get('/berkas_persyaratan/create/{permohonan_id?}', [BerkasPersyaratanController::class, 'create'])
            ->name('berkas_persyaratan.create.with_param');

        Route::get('/berkas_persyaratan/download/{mediaId}', [BerkasPersyaratanController::class, 'downloadFile'])
            ->name('berkas_persyaratan.download');
    });
});
