<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin routes (middleware: auth, role:admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Master Data CRUD
    Route::resource('tingkat', App\Http\Controllers\MasterData\TingkatController::class);
    Route::resource('jurusan', App\Http\Controllers\MasterData\JurusanController::class);
    Route::resource('kelas', App\Http\Controllers\MasterData\KelasController::class);
    Route::resource('mapel', App\Http\Controllers\MasterData\MapelController::class);
    Route::resource('tahun-ajaran', App\Http\Controllers\MasterData\TahunAjaranController::class);

    // Manajemen Guru & Santri
    Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
    Route::resource('santri', App\Http\Controllers\Admin\SantriController::class);

    // KRS Management
    Route::get('/krs', [App\Http\Controllers\Admin\KrsController::class, 'index'])->name('krs.index');
    Route::get('/krs/{krs}', [App\Http\Controllers\Admin\KrsController::class, 'show'])->name('krs.show');
    Route::post('/krs/{krs}/approve', [App\Http\Controllers\Admin\KrsController::class, 'approve'])->name('krs.approve');
    Route::post('/krs/{krs}/reject', [App\Http\Controllers\Admin\KrsController::class, 'reject'])->name('krs.reject');
    Route::get('/krs/{krs}/print', [App\Http\Controllers\Admin\KrsController::class, 'print'])->name('krs.print');
});

// Guru routes (middleware: auth, role:guru)
Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jadwal', [App\Http\Controllers\Guru\JadwalController::class, 'index'])->name('jadwal');
    Route::get('/nilai', [App\Http\Controllers\Guru\NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/{kelas}/{mapel}', [App\Http\Controllers\Guru\NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai', [App\Http\Controllers\Guru\NilaiController::class, 'store'])->name('nilai.store');
    Route::put('/nilai/{nilai}', [App\Http\Controllers\Guru\NilaiController::class, 'update'])->name('nilai.update');
    Route::get('/nilai/{kelas}/{mapel}/print', [App\Http\Controllers\Guru\NilaiController::class, 'print'])->name('nilai.print');
});

// Santri routes (middleware: auth, role:santri)
Route::prefix('santri')->name('santri.')->middleware(['auth', 'role:santri'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Santri\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/krs/create', [App\Http\Controllers\Santri\KrsController::class, 'create'])->name('krs.create');
    Route::post('/krs', [App\Http\Controllers\Santri\KrsController::class, 'store'])->name('krs.store');
    Route::get('/krs', [App\Http\Controllers\Santri\KrsController::class, 'index'])->name('krs.index');
    Route::get('/jadwal', [App\Http\Controllers\Santri\JadwalController::class, 'index'])->name('jadwal');
    Route::get('/nilai', [App\Http\Controllers\Santri\NilaiController::class, 'index'])->name('nilai');
    Route::get('/nilai/print', [App\Http\Controllers\Santri\NilaiController::class, 'print'])->name('nilai.print');
    Route::get('/krs/{krs}/print', [App\Http\Controllers\Santri\KrsController::class, 'print'])->name('krs.print');
    Route::get('/profil', [App\Http\Controllers\Santri\ProfilController::class, 'index'])->name('profil');
});
