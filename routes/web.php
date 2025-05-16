<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\EventSekolahController;

Route::get('/', function () {
    return view('halaman1');
});

Route::get('/view/profilguru', function () {
    $guru = DB::table('guru')->get();
    return view('profilguru', compact('guru'));
});

Route::get('/view/ekstrakulikuler', function () {
    $ekskul = DB::table('ekstrakurikuler')->get();
    return view('ekstrakulikuler', compact('ekskul'));
});

Route::get('/view/eventsekolah', [EventSekolahController::class, 'showEvents']);

// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Tambahkan baris ini:
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Semua route admin di-protect auth
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Guru Routes
    Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
    Route::get('/guru/tambah', [GuruController::class, 'create'])->name('admin.tambah.guru');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('admin.store.guru');
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit'])->name('admin.edit.guru');
    Route::put('/guru/update/{id}', [GuruController::class, 'update'])->name('admin.update.guru');
    Route::delete('/guru/delete/{id}', [GuruController::class, 'destroy'])->name('admin.delete.guru');

    // Ekstrakurikuler Routes
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler');
    Route::get('/ekstrakurikuler/tambah', [EkstrakurikulerController::class, 'create'])->name('admin.tambah.ekstrakurikuler');
    Route::post('/ekstrakurikuler/store', [EkstrakurikulerController::class, 'store'])->name('admin.store.ekstrakurikuler');
    Route::get('/ekstrakurikuler/edit/{id}', [EkstrakurikulerController::class, 'edit'])->name('admin.edit.ekstrakurikuler');
    Route::put('/ekstrakurikuler/update/{id}', [EkstrakurikulerController::class, 'update'])->name('admin.update.ekstrakurikuler');
    Route::delete('/ekstrakurikuler/delete/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.delete.ekstrakurikuler');

    // Route::get('/ekstrakurikuler', function () {
    //     return view('admin.ekstrakurikuler');
    // })->name('admin.ekstrakurikuler');

    //Event Sekolah Routes
    Route::get('/eventsekolah', [EventSekolahController::class, 'index'])->name('admin.eventsekolah'); 
    Route::get('/eventsekolah/tambah', [EventSekolahController::class, 'create'])->name('admin.tambah.eventsekolah');
    Route::post('/eventsekolah/store', [EventSekolahController::class, 'store'])->name('admin.store.eventsekolah');
    Route::get('/eventsekolah/edit/{id}', [EventSekolahController::class, 'edit'])->name('admin.edit.eventsekolah');
    Route::put('/eventsekolah/update/{id}', [EventSekolahController::class, 'update'])->name('admin.update.eventsekolah');
    Route::delete('/eventsekolah/delete/{id}', [EventSekolahController::class, 'destroy'])->name('admin.delete.eventsekolah');
    
    // Route::get('/event', function () {
    //     return view('admin.eventsekolah');
    // })->name('admin.eventsekolah');
});


