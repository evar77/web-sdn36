<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\EventSekolahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ForgotPasswordController;

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
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

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

    //Event Sekolah Routes
    Route::get('/eventsekolah', [EventSekolahController::class, 'index'])->name('admin.eventsekolah'); 
    Route::get('/eventsekolah/tambah', [EventSekolahController::class, 'create'])->name('admin.tambah.eventsekolah');
    Route::post('/eventsekolah/store', [EventSekolahController::class, 'store'])->name('admin.store.eventsekolah');
    Route::get('/eventsekolah/edit/{id}', [EventSekolahController::class, 'edit'])->name('admin.edit.eventsekolah');
    Route::put('/eventsekolah/update/{id}', [EventSekolahController::class, 'update'])->name('admin.update.eventsekolah');
    Route::delete('/eventsekolah/delete/{id}', [EventSekolahController::class, 'destroy'])->name('admin.delete.eventsekolah');
});

// Admin Password Reset Routes
Route::get('admin/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('admin.password.request');
Route::post('admin/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('admin.password.email');
Route::get('admin/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('admin.password.reset');
Route::post('admin/reset-password', [ForgotPasswordController::class, 'reset'])
    ->name('admin.password.update');


