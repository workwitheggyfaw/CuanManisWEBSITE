<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KosanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// =======================
// ROUTE UTAMA / BERANDA
// =======================

Route::get('/', function () {
    return view('index');
})->name('home');

// =======================
// AUTH
// =======================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// DASHBOARD (Setelah login)
// =======================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/graph', [DashboardController::class, 'graph'])->name('dashboard.graph');
// =======================
// PROFILE (user settings)
// =======================

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('show');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete', [ProfileController::class, 'destroy'])->name('delete');
});

// =======================
// BARANG ROUTES (CRUD + publik)
// =======================

// Public display (tanpa login)
Route::get('/barang', [BarangController::class, 'beranda'])->name('barang.beranda');
Route::get('/barang/barang-market', [BarangController::class, 'market'])->name('barang.market');
Route::get('/barang/{id_barang}', [BarangController::class, 'show'])->name('barang.show');

// Protected routes (hanya user login)
Route::middleware('auth')->prefix('barang')->name('barang.')->group(function () {
    Route::get('/list', [BarangController::class, 'index'])->name('list');        // Tampilkan daftar milik user
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');       // Form tambah
    Route::post('/store', [BarangController::class, 'store'])->name('store');    // Simpan barang baru
    Route::get('/edit/{id_barang}', [BarangController::class, 'edit'])->name('edit');    // Form edit
    Route::put('/update/{id_barang}', [BarangController::class, 'update'])->name('update');
    Route::delete('/delete/{id_barang}', [BarangController::class, 'destroy'])->name('delete');
});

/////
/////KOS//////
///////


// Public display
Route::get('/kos', [KosanController::class, 'beranda'])->name('kos.beranda');
Route::get('/kos-market', [KosanController::class, 'market'])->name('kos.market'); // untuk tampilan semua kosan
Route::get('/kos-detail/{id_kos}', [KosanController::class, 'show'])->name('kos.detail'); // Route untuk detail kosan (publik)

// Protected routes
Route::middleware('auth')->prefix('kos')->name('kos.')->group(function () {
    Route::get('/list', [KosanController::class, 'list'])->name('list');
    Route::get('/create', [KosanController::class, 'create'])->name('create');
    Route::post('/store', [KosanController::class, 'store'])->name('store');
    Route::get('/edit/{id_kos}', [KosanController::class, 'edit'])->name('edit');
    Route::put('/update/{id_kos}', [KosanController::class, 'update'])->name('update');
    Route::delete('/delete/{id_kos}', [KosanController::class, 'destroy'])->name('delete');
});
