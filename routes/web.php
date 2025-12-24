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
Route::get('/', function () {
    return view('pages.home.dashboard');
})->name('home');

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

    // ============ ROUTES KHUSUS ADMIN ============
    Route::group(['middleware' => ['checkrole:Admin']], function () {
        // Admin: Full CRUD untuk semua
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

    // ============ ROUTES UNTUK ADMIN DAN WARGA ============
    Route::group(['middleware' => ['checkrole:Admin,Warga']], function () {
        // Jenis Surat: semua bisa lihat
        Route::get('/jenis_surat', [JenisSuratController::class, 'index'])->name('jenis_surat.index');
        Route::get('/jenis_surat/{id}', [JenisSuratController::class, 'show'])->name('jenis_surat.show');
        Route::get('/jenis_surat/download/{id}', [JenisSuratController::class, 'downloadTemplate'])->name('jenis_surat.download_template');

        // Warga: CRUD untuk data sendiri (controller akan handle authorization)
        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
        Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

        // Permohonan Surat: CRUD untuk data sendiri
        Route::get('/permohonan_surat', [PermohonanSuratController::class, 'index'])->name('permohonan_surat.index');
        Route::get('/permohonan_surat/create', [PermohonanSuratController::class, 'create'])->name('permohonan_surat.create');
        Route::post('/permohonan_surat', [PermohonanSuratController::class, 'store'])->name('permohonan_surat.store');
        Route::get('/permohonan_surat/{id}', [PermohonanSuratController::class, 'show'])->name('permohonan_surat.show');
        Route::get('/permohonan_surat/{id}/edit', [PermohonanSuratController::class, 'edit'])->name('permohonan_surat.edit');
        Route::put('/permohonan_surat/{id}', [PermohonanSuratController::class, 'update'])->name('permohonan_surat.update');
        Route::delete('/permohonan_surat/{id}', [PermohonanSuratController::class, 'destroy'])->name('permohonan_surat.destroy');

        // Berkas Persyaratan: CRUD untuk data sendiri
        Route::get('/berkas_persyaratan', [BerkasPersyaratanController::class, 'index'])->name('berkas_persyaratan.index');
        Route::get('/berkas_persyaratan/create', [BerkasPersyaratanController::class, 'create'])->name('berkas_persyaratan.create');
        Route::post('/berkas_persyaratan', [BerkasPersyaratanController::class, 'store'])->name('berkas_persyaratan.store');
        Route::get('/berkas_persyaratan/{id}', [BerkasPersyaratanController::class, 'show'])->name('berkas_persyaratan.show');
        Route::get('/berkas_persyaratan/{id}/edit', [BerkasPersyaratanController::class, 'edit'])->name('berkas_persyaratan.edit');
        Route::put('/berkas_persyaratan/{id}', [BerkasPersyaratanController::class, 'update'])->name('berkas_persyaratan.update');
        Route::delete('/berkas_persyaratan/{id}', [BerkasPersyaratanController::class, 'destroy'])->name('berkas_persyaratan.destroy');

        Route::get('/berkas_persyaratan/create/{permohonan_id?}', [BerkasPersyaratanController::class, 'create'])
            ->name('berkas_persyaratan.create.with_param');

        Route::get('/berkas_persyaratan/download/{mediaId}', [BerkasPersyaratanController::class, 'downloadFile'])
            ->name('berkas_persyaratan.download');

        // Riwayat Status: semua bisa lihat
        Route::get('/riwayat_status', [RiwayatStatusController::class, 'index'])->name('riwayat_status.index');
        Route::get('/riwayat_status/{id}', [RiwayatStatusController::class, 'show'])->name('riwayat_status.show');
    });
});
