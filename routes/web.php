<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// KONDISI BARU (Langsung Melompat ke Halaman Login TIF)
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup Route yang Wajib Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard bersifat dinamis, diarahkan oleh DashboardController sesuai role
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Profil Pengguna (Fitur Umum)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // 1. OTORITAS ROUTE: ADMIN ONLY
    // ==========================================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class);
        Route::resource('dosen', \App\Http\Controllers\Admin\DosenController::class);
        Route::resource('mata-kuliah', \App\Http\Controllers\Admin\MataKuliahController::class);
        Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
        Route::resource('ruangan', \App\Http\Controllers\Admin\RuanganController::class);
        Route::resource('jadwal', \App\Http\Controllers\Admin\JadwalKuliahController::class);
        
        // PERBAIKAN: URL diperpendek karena sudah ada prefix 'admin', dan nama rute cukup 'laporan.khs' (akan otomatis digabung grup menjadi admin.laporan.khs)
        Route::get('/laporan/cetak-khs/{id}', [\App\Http\Controllers\Admin\LaporanController::class, 'cetakKhs'])->name('laporan.khs');
        
        Route::get('/log-aktivitas', function () { return 'Halaman Log'; })->name('logs');
    });

    // ==========================================
    // 2. OTORITAS ROUTE: DOSEN ONLY
    // ==========================================
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        // Rute Transaksional Absensi (Tahap 6)
        Route::get('/absensi', [\App\Http\Controllers\Dosen\AbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/create', [\App\Http\Controllers\Dosen\AbsensiController::class, 'create'])->name('absensi.create');
        Route::post('/absensi/store', [\App\Http\Controllers\Dosen\AbsensiController::class, 'store'])->name('absensi.store');

        Route::get('/nilai', [\App\Http\Controllers\Dosen\NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/create', [\App\Http\Controllers\Dosen\NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai/store', [\App\Http\Controllers\Dosen\NilaiController::class, 'store'])->name('nilai.store');
        Route::resource('materi', \App\Http\Controllers\Dosen\MateriController::class)->except(['show', 'edit', 'update']);
    });

    // ==========================================
// 3. OTORITAS ROUTE: MAHASISWA ONLY
// ==========================================
    // ==========================================
    // 3. OTORITAS ROUTE: MAHASISWA ONLY
    // ==========================================
    // ==========================================
    // 3. OTORITAS ROUTE: MAHASISWA ONLY
    // ==========================================
    // ==========================================
    // 3. OTORITAS ROUTE: MAHASISWA ONLY
    // ==========================================
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'dashboard'])->name('dashboard');
        
        // RUTE KONTRAK KRS MANUAL BARU
        Route::get('/krs', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs/ambil/{id}', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'ambil'])->name('krs.ambil');
        Route::post('/krs/batal/{id}', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'batal'])->name('krs.batal');

        Route::get('/materi', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'index'])->name('materi.index');
        Route::get('/khs', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'khs'])->name('khs');
        Route::get('/presensi', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'presensi'])->name('presensi');
    });
});

require __DIR__.'/auth.php';