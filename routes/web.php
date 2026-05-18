<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermohonanMagangController;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');


// Route untuk semua user yang sudah login (Mahasiswa & Admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Mahasiswa
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route khusus Mahasiswa (untuk daftar magang)
    Route::get('/permohonan', [PermohonanMagangController::class, 'create'])->name('permohonan.create');
    Route::post('/permohonan', [PermohonanMagangController::class, 'store'])->name('permohonan.store');
    Route::get('/download-dokumen', [PermohonanMagangController::class, 'showDownload'])->name('permohonan.download');
});

// Route KHUSUS Admin (Pakai Middleware Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Taruh ini sebelum route yang ada {id}
    Route::get('/dokumen-output', [AdminController::class, 'listDokumen'])->name('admin.permohonan.list-dokumen');

    Route::get('/permohonan', [AdminController::class, 'listPermohonan'])->name('admin.permohonan.index');
    Route::get('/permohonan/{id}', [AdminController::class, 'show'])->name('admin.permohonan.show');
    Route::get('/permohonan/{id}/dokumen', [AdminController::class, 'manageDokumen'])->name('admin.permohonan.dokumen');
    
    Route::patch('/application/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.update-status');
    Route::patch('/permohonan/{id}/upload-dokumen', [AdminController::class, 'uploadDokumenHasil'])->name('admin.upload-dokumen-hasil');

    Route::get('/settings/user-manual', [AdminController::class, 'manageUserManual'])->name('admin.settings.manual');
    Route::post('/settings/user-manual', [AdminController::class, 'uploadUserManual'])->name('admin.settings.manual.update');
});

require __DIR__.'/auth.php';
