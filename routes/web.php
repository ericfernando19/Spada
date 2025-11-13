<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================
// 🟢 IMPORT CONTROLLER
// ==========================
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\UserController;

// Guru
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\MataPelajaranController as GuruMataPelajaranController;
use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\Guru\SubmateriController;
use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\Guru\SiswaDiajarController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\SoalController;
use App\Http\Controllers\Guru\MataPelajaranController as GuruMataPelajaran;

// Siswa
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

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

// =====================================
// 🔹 DASHBOARD ADMIN + CRUD DATA MASTER
// =====================================
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

    // Import Data
    Route::get('/import', [ImportController::class, 'showForm'])->name('import.form');
    Route::post('/import/guru', [ImportController::class, 'importGuru'])->name('import.guru');
    Route::post('/import/siswa', [ImportController::class, 'importSiswa'])->name('import.siswa');

    // Manajemen User (edit/hapus)
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// =====================================
// 🔹 DASHBOARD GURU + FITUR AJARAN
// =====================================
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('guru.dashboard');

    // 🔹 Kelola Mata Pelajaran (Course)
    Route::get('/mata-pelajaran', [GuruMataPelajaranController::class, 'index'])->name('guru.mata-pelajaran');
    Route::post('/mata-pelajaran', [GuruMataPelajaranController::class, 'store'])->name('guru.mata-pelajaran.store');
    Route::put('/mata-pelajaran/{id}', [GuruMataPelajaranController::class, 'update'])->name('guru.mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{id}', [GuruMataPelajaranController::class, 'destroy'])->name('guru.mata-pelajaran.destroy');
    Route::get('/mata-pelajaran/{id}/isi', [GuruMataPelajaranController::class, 'isi'])->name('guru.mata-pelajaran.isi');

    // 🔹 Materi dan Submateri
    Route::post('/materi/tambah/{course}', [MateriController::class, 'store'])->name('materi.tambah');
    Route::put('/materi/update/{materi}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/hapus/{materi}', [MateriController::class, 'destroy'])->name('materi.hapus');

    Route::post('/materi/{materiId}/submateri/store', [SubmateriController::class, 'store'])->name('submateri.store');
    Route::put('/submateri/{id}/update', [SubmateriController::class, 'update'])->name('submateri.update');
    Route::delete('/submateri/{id}/delete', [SubmateriController::class, 'destroy'])->name('submateri.destroy');

    // 🔹 Tugas
    Route::post('/submateri/{id}/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    // Route::get('/materi/{materi_id}/soal/create', [SoalController::class, 'create'])->name('guru.soal.create'); // Baris ini duplikat, ada di bawah


    // 🔹 Posttest (Soal Pilgan & Esai Mix) <-- RUTE BARU DITAMBAHKAN DI SINI
    Route::get('/tugas/{tugas}/manage-soal', [TugasController::class, 'manageSoal'])
         ->name('guru.tugas.manageSoal');
    Route::post('/tugas/{tugas}/save-soal', [SoalController::class, 'storeForTugas'])
         ->name('guru.soal.storeForTugas');


    // 🔹 Soal (LATIHAN per materi)
    Route::get('/materi/{materi_id}/soal', [SoalController::class, 'index'])->name('guru.soal.index');
    Route::get('/materi/{materi_id}/soal/create', [SoalController::class, 'create'])->name('guru.soal.create');
    Route::post('/materi/{materi_id}/soal', [SoalController::class, 'store'])->name('guru.soal.store');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('guru.soal.destroy');

    // 🔹 Absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('guru.absensi.index');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('guru.absensi.store');
    Route::post('/absensi/simpan', [AbsensiController::class, 'store'])->name('guru.absensi.simpan');
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('guru.absensi.rekap');
    Route::put('/guru/absensi/{id}', [AbsensiController::class, 'update'])->name('guru.absensi.update');
    Route::delete('/guru/absensi/{id}', [AbsensiController::class, 'destroy'])->name('guru.absensi.destroy');

    // 🔹 Daftar Siswa yang Diajar
    Route::get('/siswa-diajar', [SiswaDiajarController::class, 'index'])->name('guru.siswa-diajar.index');

    // 🔹 Detail Mata Pelajaran (show)
    Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/mata-pelajaran/{id}', [GuruMataPelajaranController::class, 'show'])->name('mata-pelajaran.show');
    });

    // 🔹 Tambah Materi (form + simpan)
    Route::get('/materi/create/{course}', [MateriController::class, 'create'])->name('guru.materi.create');
    Route::post('/materi/store/{courseId}', [MateriController::class, 'store'])->name('guru.materi.store');

});

// =====================================
// 🔹 DASHBOARD SISWA
// =====================================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('siswa.dashboard');
});
