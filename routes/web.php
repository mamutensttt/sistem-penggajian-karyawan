<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::get('/logout', function () {
    return redirect()->route('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    Route::get('/gaji', [GajiKaryawanController::class, 'index'])->name('gaji.index');
    Route::get('/gaji/create', [GajiKaryawanController::class, 'create'])->name('gaji.create');
    Route::post('/gaji', [GajiKaryawanController::class, 'store'])->name('gaji.store');
    Route::get('/karyawan/{karyawan}/export-pdf', [GajiKaryawanController::class, 'exportPdf'])->name('karyawan.export.pdf');
});
