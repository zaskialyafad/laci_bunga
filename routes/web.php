<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup Route untuk ADMIN
Route::middleware(['auth'])->group(function () {
    
    // 1. Halaman Daftar Produk     
    Route::get('/project/view-data', [ProductController::class, 'index'])->name('admin.dashboard');

    // 2. Halaman Form Tambah Produk    
    Route::get('/project/tambah', [ProductController::class, 'tambah'])->name('project.tambah');

    // 3. Simpan Produk Baru    
    Route::post('/project/simpan', [ProductController::class, 'simpanProduk'])->name('project.simpanProduk');

    // 4. Halaman Edit Produk
    Route::get('/project/edit/{product}', [ProductController::class, 'edit'])->name('project.edit');

    // 5. Update Data Produk 
    Route::put('/project/update/{product}', [ProductController::class, 'editProduct'])->name('project.update');

    // 6. Hapus Produk 
    Route::delete('/project/delete/{product}', [ProductController::class, 'delete'])->name('project.delete');
});

require __DIR__.'/auth.php';