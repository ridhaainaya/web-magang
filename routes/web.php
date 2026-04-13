<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermohonanMagangController;

use App\Http\Controllers\LandingPageController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/permohonan', [PermohonanMagangController::class, 'create'])->name('permohonan.create');
    Route::post('/permohonan', [PermohonanMagangController::class, 'store'])->name('permohonan.store');
    Route::get('/download-dokumen', [PermohonanMagangController::class, 'showDownload'])->name('permohonan.download');
});

require __DIR__.'/auth.php';
