<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth:web,kepsek,admin'])->group(function () {
    Route::get('/dashboard', [BerandaController::class, 'index'])->name('dashboard');
});

// Semua route untuk mengelola data admin
Route::middleware(['auth:admin,web', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/view', [AdminController::class, 'adminView'])->name('admin.view');
        Route::get('/detail', [AdminController::class, 'adminDetail'])->name('admin.detail');
        Route::get('/add', [AdminController::class, 'adminAdd'])->name('admin.add');
        Route::get('/edit', [AdminController::class, 'adminEdit'])->name('admin.edit');
    });
});