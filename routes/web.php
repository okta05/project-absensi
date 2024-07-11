<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\data_pengguna\KepsekController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:web,kepsek,admin', 'verified'] )->group(function () {
    Route::get('/dashboard', [BerandaController::class, 'index'])->name('dashboard');
});

// Semua route untuk mengelola data admin
Route::middleware(['auth:admin,web,kepsek', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/view', [AdminController::class, 'adminView'])->name('admin.view');
        Route::get('/detail', [AdminController::class, 'adminDetail'])->name('admin.detail');
        Route::get('/add', [AdminController::class, 'adminAdd'])->name('admin.add');
        Route::get('/edit', [AdminController::class, 'adminEdit'])->name('admin.edit');
    });
});

// Semua route untuk mengelola data siswa
Route::middleware(['auth:web,admin,kepsek', 'verified'])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/view', [SiswaController::class, 'siswaView'])->name('siswa.view');
        Route::get('/add', [SiswaController::class, 'siswaAdd'])->name('siswa.add');
        Route::get('/detail', [SiswaController::class, 'siswaDetail'])->name('siswa.detail');
        Route::get('/edit', [SiswaController::class, 'siswaEdit'])->name('siswa.edit');
    });
});

// Semua route untuk mengelola data kepala sekolah
Route::middleware(['auth:web,kepsek,admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/kepala-sekolah')->group(function () {
        Route::get('/view', [KepsekController::class, 'kepsekView'])->name('kepsek.view');
        Route::get('/add', [KepsekController::class, 'kepsekAdd'])->name('kepsek.add');
        Route::get('/detail', [KepsekController::class, 'kepsekDetail'])->name('kepsek.detail');
        Route::get('/edit', [KepsekController::class, 'kepsekEdit'])->name('kepsek.edit');
    });
});