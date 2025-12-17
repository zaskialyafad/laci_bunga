<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

// Route view data
Route::get('/', [ProductController::class, 'index'])->name('project.view-data');
Route::get('/view-data', [ProductController::class, 'index']) ->name('project.view-data');


// Route tambah product
Route::get('/project/tambah', [ProductController::class, 'tambah'])->name('project.tambah');
Route::post('/project/tambah', [ProductController::class, 'simpanProjek']);

// Route edit product
Route::get('/project/edit/{product}', [ProductController::class, 'edit'])->name('project.edit');
Route::post('/project/update/{product}', [ProductController::class, 'editProduct']);