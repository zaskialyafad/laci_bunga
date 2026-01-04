<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;



// --- GUEST ROUTES (Bisa diakses tanpa login) ---
Route::get('/', [HomeController::class, 'index'])->name('web.home-page');
Route::get('/all-produk', [ProductController::class, 'allProduk'])->name('web.all-produk');
Route::get('/detail-produk/{product}', [ProductController::class, 'detail'])->name('web.detail-produk');

// --- AUTH ROUTES (Harus login) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard & Profile
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Product Management
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/view-data', [ProductController::class, 'index'])->name('view-data');
        Route::get('/tambah', [ProductController::class, 'tambah'])->name('tambah');
        Route::post('/simpan', [ProductController::class, 'simpanProduk'])->name('simpanProduk');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'editProduct'])->name('update');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    });
    

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });

    // Wishlist Routes
    Route::prefix('wishlist')->name('wishlist.')->group(function() {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
        Route::delete('/remove/{id}', [WishlistController::class, 'remove'])->name('remove');
    });

    // Checkout Routes
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    route::get('/success', function(){return"Pembayaran Berhasil!";});
});

require __DIR__.'/auth.php';