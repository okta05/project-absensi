<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\data_pengguna\KepsekController;
use App\Http\Controllers\data_pengguna\KurikulumController;
use App\Http\Controllers\data_pengguna\BKController;
use App\Http\Controllers\data_pengguna\WakelController;
use App\Http\Controllers\data_pengguna\GuruController;

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

// Semua route untuk mengelola data kurikulum
Route::middleware(['auth:web,kepsek,admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/kurikulum')->group(function () {
        Route::get('/view', [KurikulumController::class, 'kurikulumView'])->name('kurikulum.view');
        Route::get('/add', [KurikulumController::class, 'kurikulumAdd'])->name('kurikulum.add');
        Route::get('/detail', [KurikulumController::class, 'kurikulumDetail'])->name('kurikulum.detail');
        Route::get('/edit', [KurikulumController::class, 'kurikulumEdit'])->name('kurikulum.edit');
    });
});

// Semua route untuk mengelola data BK
Route::middleware(['auth:web,kepsek,admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/bk')->group(function () {
        Route::get('/view', [BkController::class, 'bkView'])->name('bk.view');
        Route::get('/add', [BkController::class, 'bkAdd'])->name('bk.add');
        Route::get('/detail', [BkController::class, 'bkDetail'])->name('bk.detail');
        Route::get('/edit', [BkController::class, 'bkEdit'])->name('bk.edit');
    });
});

// Semua route untuk mengelola data wali kelas
Route::middleware(['auth:web,kepsek,admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/wali-kelas')->group(function () {
        Route::get('/view', [WakelController::class, 'wakelView'])->name('wakel.view');
        Route::get('/add', [WakelController::class, 'wakelAdd'])->name('wakel.add');
        Route::get('/detail', [WakelController::class, 'wakelDetail'])->name('wakel.detail');
        Route::get('/edit', [WakelController::class, 'wakelEdit'])->name('wakel.edit');
    });
});

// Semua route untuk mengelola data guru
Route::middleware(['auth:web,kepsek,admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/guru')->group(function () {
        Route::get('/view', [GuruController::class, 'guruView'])->name('guru.view');
        Route::get('/add', [GuruController::class, 'guruAdd'])->name('guru.add');
        Route::get('/detail', [GuruController::class, 'guruDetail'])->name('guru.detail');
        Route::get('/edit', [GuruController::class, 'guruEdit'])->name('guru.edit');
    });
});