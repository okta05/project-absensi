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
use App\Http\Controllers\data\KelasController;
use App\Http\Controllers\data\MapelController;
use App\Http\Controllers\data\TahpelController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
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

Route::middleware(['auth:kepsek,admin,kurikulum,bk,wakel,guru', 'verified'] )->group(function () {
    Route::get('/dashboard', [BerandaController::class, 'index'])->name('dashboard');
});

// Semua route untuk mengelola data admin
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/view', [AdminController::class, 'adminView'])->name('admin.view');
        Route::get('/detail/{id}', [AdminController::class, 'adminDetail'])->name('admin.detail');
        Route::get('/add', [AdminController::class, 'adminAdd'])->name('admin.add');
        Route::post('/simpan', [AdminController::class, 'adminStore'])->name('admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'adminEdit'])->name('admin.edit');
        Route::post('/update/{id}', [AdminController::class, 'adminUpdate'])->name('admin.update');
        Route::get('/delete/{id}', [AdminController::class, 'adminDelete'])->name('admin.delete');
    });
});

// Semua route untuk mengelola data siswa
Route::middleware(['auth:admin,kepsek,kurikulum,bk,wakel,guru', 'verified'])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/view', [SiswaController::class, 'siswaView'])->name('siswa.view');
        Route::get('/detail/{id}', [SiswaController::class, 'siswaDetail'])->name('siswa.detail');
        Route::get('/add', [SiswaController::class, 'siswaAdd'])->name('siswa.add');
        Route::post('/simpan', [SiswaController::class, 'siswaStore'])->name('siswa.store');
        Route::get('/edit/{id}', [SiswaController::class, 'siswaEdit'])->name('siswa.edit');
        Route::post('/update/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');
        Route::get('/delete/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');
        Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    });
});

// Semua route untuk mengelola data kepala sekolah
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/kepala-sekolah')->group(function () {
        Route::get('/view', [KepsekController::class, 'kepsekView'])->name('kepsek.view');
        Route::get('/detail/{id}', [KepsekController::class, 'kepsekDetail'])->name('kepsek.detail');
        Route::get('/add', [KepsekController::class, 'kepsekAdd'])->name('kepsek.add');
        Route::post('/simpan', [KepsekController::class, 'kepsekStore'])->name('kepsek.store');
        Route::get('/edit/{id}', [KepsekController::class, 'kepsekEdit'])->name('kepsek.edit');
        Route::post('/update/{id}', [KepsekController::class, 'kepsekUpdate'])->name('kepsek.update');
        Route::get('/delete/{id}', [KepsekController::class, 'kepsekDelete'])->name('kepsek.delete');
    });
});

// Semua route untuk mengelola data kurikulum
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/kurikulum')->group(function () {
        Route::get('/view', [KurikulumController::class, 'kurikulumView'])->name('kurikulum.view');
        Route::get('/detail/{id}', [KurikulumController::class, 'kurikulumDetail'])->name('kurikulum.detail');
        Route::get('/add', [KurikulumController::class, 'kurikulumAdd'])->name('kurikulum.add');
        Route::post('/store', [KurikulumController::class, 'kurikulumStore'])->name('kurikulum.store');
        Route::get('/edit/{id}', [KurikulumController::class, 'kurikulumEdit'])->name('kurikulum.edit');
        Route::post('/update/{id}', [KurikulumController::class, 'kurikulumUpdate'])->name('kurikulum.update');
        Route::get('/delete/{id}', [KurikulumController::class, 'kurikulumDelete'])->name('kurikulum.delete');
    });
});

// Semua route untuk mengelola data BK
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/bk')->group(function () {
        Route::get('/view', [BkController::class, 'bkView'])->name('bk.view');
        Route::get('/detail/{id}', [BkController::class, 'bkDetail'])->name('bk.detail');
        Route::get('/add', [BkController::class, 'bkAdd'])->name('bk.add');
        Route::post('/simpan', [BkController::class, 'bkStore'])->name('bk.store');
        Route::get('/edit/{id}', [BkController::class, 'bkEdit'])->name('bk.edit');
        Route::post('/update/{id}', [BkController::class, 'bkUpdate'])->name('bk.update');
        Route::get('/delete/{id}', [BkController::class, 'bkDelete'])->name('bk.delete');
    });
});

// Semua route untuk mengelola data wakel
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/wali-kelas')->group(function () {
        Route::get('/view', [WakelController::class, 'wakelView'])->name('wakel.view');
        Route::get('/detail/{id}', [WakelController::class, 'wakelDetail'])->name('wakel.detail');
        Route::get('/add', [WakelController::class, 'wakelAdd'])->name('wakel.add');
        Route::post('/simpan', [WakelController::class, 'wakelStore'])->name('wakel.store');
        Route::get('/edit/{id}', [WakelController::class, 'wakelEdit'])->name('wakel.edit');
        Route::post('/update/{id}', [WakelController::class, 'wakelUpdate'])->name('wakel.update');
        Route::get('/delete/{id}', [WakelController::class, 'wakelDelete'])->name('wakel.delete');
    });
});

// Semua route untuk mengelola data guru
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data-pengguna/guru')->group(function () {
        Route::get('/view', [GuruController::class, 'guruView'])->name('guru.view');
        Route::get('/detail/{id}', [GuruController::class, 'guruDetail'])->name('guru.detail');
        Route::get('/add', [GuruController::class, 'guruAdd'])->name('guru.add');
        Route::post('/simpan', [GuruController::class, 'guruStore'])->name('guru.store');
        Route::get('/edit/{id}', [GuruController::class, 'guruEdit'])->name('guru.edit');
        Route::post('/update/{id}', [GuruController::class, 'guruUpdate'])->name('guru.update');
        Route::get('/delete/{id}', [GuruController::class, 'guruDelete'])->name('guru.delete');
    });
});

// Semua route untuk mengelola data kelas
Route::middleware(['auth:admin,kurikulum', 'verified'])->group(function () {
    Route::prefix('data/kelas')->group(function () {
        Route::get('/view', [KelasController::class, 'kelasView'])->name('kelas.view');
        Route::get('/add', [KelasController::class, 'kelasAdd'])->name('kelas.add');
        Route::post('/simpan', [KelasController::class, 'kelasStore'])->name('kelas.store');
        Route::get('/edit/{id}', [KelasController::class, 'kelasEdit'])->name('kelas.edit');
        Route::post('/update/{id}', [KelasController::class, 'kelasUpdate'])->name('kelas.update');
        Route::get('/delete/{id}', [KelasController::class, 'kelasDelete'])->name('kelas.delete');
    });
});

// Semua route untuk mengelola data mapel
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data/mapel')->group(function () {
        Route::get('/view', [MapelController::class, 'mapelView'])->name('mapel.view');
        Route::get('/add', [MapelController::class, 'mapelAdd'])->name('mapel.add');
        Route::post('/simpan', [MapelController::class, 'mapelStore'])->name('mapel.store');
        Route::get('/edit/{id}', [MapelController::class, 'mapelEdit'])->name('mapel.edit');
        Route::post('/update/{id}', [MapelController::class, 'mapelUpdate'])->name('mapel.update');
        Route::get('/delete/{id}', [MapelController::class, 'mapelDelete'])->name('mapel.delete');
    });
});

// Semua route untuk mengelola data tahun pelajaran
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('data/tahun-pelajaran')->group(function () {
        Route::get('/view', [TahpelController::class, 'tahpelView'])->name('tahpel.view');
        Route::get('/add', [TahpelController::class, 'tahpelAdd'])->name('tahpel.add');
        Route::post('/simpan', [TahpelController::class, 'tahpelStore'])->name('tahpel.store');
        Route::get('/edit/{id}', [TahpelController::class, 'tahpelEdit'])->name('tahpel.edit');
        Route::post('/update/{id}', [TahpelController::class, 'tahpelUpdate'])->name('tahpel.update');
        Route::get('/delete/{id}', [TahpelController::class, 'tahpelDelete'])->name('tahpel.delete');
    });
});

// Semua route untuk mengelola absensi
Route::middleware(['auth:admin,kepsek,bk,wakel,guru', 'verified'])->group(function () {
    Route::prefix('data/absensi')->group(function () {
        Route::get('/pilih-mapel', [AbsensiController::class, 'pilihMapel'])->name('mapel.absensi');
        Route::get('/pilih-data-absensi', [AbsensiController::class, 'pilihDataAbsensi'])->name('pilih_data.absensi');
        Route::get('/detail/{id}', [AbsensiController::class, 'absensiDetail'])->name('absensi.detail');
        Route::get('/add', [AbsensiController::class, 'absensiAdd'])->name('add.absensi');
        Route::post('/simpan', [AbsensiController::class, 'absensiStore'])->name('absensi.store');
        Route::get('/absensi/edit/{id}', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
        Route::post('/absensi/update/{id}', [AbsensiController::class, 'absensiUpdate'])->name('absensi.update');
        Route::get('/delete/{id}', [AbsensiController::class, 'absensiDelete'])->name('absensi.delete');
        Route::get('/pilih-unduh-absensi/{id}', [AbsensiController::class, 'unduhPilihan'])->name('pilih.unduhan');
        Route::get('/unduh/{id}', [AbsensiController::class, 'unduhAbsensiPilihanPDF'])->name('absensi.unduh.pdf');
        Route::get('/unduh-perbulan', [AbsensiController::class, 'unduhPerbulan'])->name('absensi.perbulan');
        Route::get('/unduh-absensi-perbulan', [AbsensiController::class, 'unduhAbsensiPerBulan'])->name('unduh_absensi_perbulan');
        Route::get('/unduh-persemester', [AbsensiController::class, 'unduhPersemester'])->name('absensi.persemester');
        Route::get('/unduh-absensi-persemester', [AbsensiController::class, 'unduhAbsensiPerSemester'])->name('unduh_absensi.persemester');
    });
});

Route::middleware(['auth:kepsek,admin,kurikulum,bk,wakel,guru', 'verified'])->group(function () {
    Route::prefix('Profile')->group(function () {
        Route::get('/view', [ProfileController::class, 'profileView'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');
        Route::post('update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/delete', [ProfileController::class, 'profileDelete'])->name('profile.delete');
    });
});