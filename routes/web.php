<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;

// ==========================
// 🟢 AUTHENTIKASI
// ==========================

// Halaman login (GET)
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Proses login (POST)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ==========================
// 🟢 DASHBOARD UTAMA (Redirect Otomatis Berdasarkan Role)
// ==========================
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();
    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru' => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403, 'Role tidak dikenal'),
    };
})->name('dashboard');

// ==========================
// 🟢 DASHBOARD & FITUR PER ROLE
// ==========================

// 🔹 Dashboard Admin + CRUD
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard utama admin
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // CRUD Guru & Siswa
    Route::resource('/guru', GuruController::class)->names('guru');
    Route::resource('/siswa', SiswaController::class)->names('siswa');

    // CRUD Mata Pelajaran
    Route::resource('/mapel', MataPelajaranController::class)->names('admin.mapel');

    // CRUD Kelas
    Route::resource('kelas', KelasController::class)
        ->names('kelas')
        ->parameters(['kelas' => 'kelas']);

    // Import Guru & Siswa
    Route::get('/import', [ImportController::class, 'showForm'])->name('import.form');
    Route::post('/import/guru', [ImportController::class, 'importGuru'])->name('import.guru');
    Route::post('/import/siswa', [ImportController::class, 'importSiswa'])->name('import.siswa');

    // 🔹 Tambahan fitur edit & hapus user (guru/siswa)
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// 🔹 Dashboard Guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('guru.dashboard');
});

// 🔹 Dashboard Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('siswa.dashboard');
});
