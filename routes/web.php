<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dash', [DashboardController::class, 'template'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.list');
Route::get('/petugas/buat', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas/simpan', [PetugasController::class, 'store'])->name('petugas.store');

Route::get('/', function () {
    return view('welcome');
});
