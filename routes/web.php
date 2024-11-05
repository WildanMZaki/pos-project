<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'process'])->name('login.process');

Route::middleware(IsLoggedIn::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dash', [DashboardController::class, 'template'])->name('home');
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    // Testing
    Route::get('/petugas/test/{name}/{age}', [PetugasController::class, 'test'])->name('petugas.test');

    // Untuk rute yang berupa halaman / menampilkan halaman, gunakan get
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.list');
    Route::get('/petugas/buat', [PetugasController::class, 'create'])->name('petugas.create');
    Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');

    // Untuk rute yang berupa proses gunakan selain get
    Route::post('/petugas/simpan', [PetugasController::class, 'store'])->name('petugas.store');
    Route::patch('/petugas/active_control/{id}', [PetugasController::class, 'active_control'])->name('petugas.active_control');
    Route::put('/petugas/update/{id}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/petugas/{petugas_id}', [PetugasController::class, 'delete'])->name('petugas.delete');

    # Fitur Transaksi belanja
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.list');
    Route::get('/purchases/new', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchases/save', [PurchaseController::class, 'store'])->name('purchases.store');

    Route::get('/', function () {
        return view('welcome');
    });
});
