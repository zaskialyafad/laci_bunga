<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home-page', [HomeController::class, 'index'])->name('web.home-page');
Route::get('/all-produk', [ProductController::class, 'allProduk'])->name('web.all-produk');
Route::get('/detail-produk/{product}', [ProductController::class, 'detai;'])->name('web.detail-produk');


Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup Route untuk ADMIN
Route::middleware(['auth'])->group(function () {
    
    // 1. Halaman Daftar Produk     
    Route::get('/admin/view-data', [ProductController::class, 'index'])->name('admin.view-data');
    // 2. Halaman Form Tambah Produk    
    Route::get('/admin/tambah', [ProductController::class, 'tambah'])->name('admin.tambah');

    // 3. Simpan Produk Baru    
    Route::post('/admin/simpan', [ProductController::class, 'simpanProduk'])->name('admin.simpanProduk');

    // 4. Halaman Edit Produk
    Route::get('/admin/edit/{product}', [ProductController::class, 'edit'])->name('admin.edit');

    // 5. Update Data Produk 
    Route::put('/admin/update/{product}', [ProductController::class, 'editProduct'])->name('admin.update');

    // 6. Hapus Produk 
    Route::delete('/admin/delete/{product}', [ProductController::class, 'delete'])->name('admin.delete');
});

require __DIR__.'/auth.php';