<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/product', [ProductController::class, 'index'])->name('product.list');
// Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
// Route::post('/product', [ProductController::class, 'store'])->name('product.store');
// Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
// Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destory');

Route::controller(ProductController::class)->group(function(){
    Route::get('/product', 'index')->name('product.list');
    Route::get('/product/create', 'create')->name('product.create');
    Route::post('/product', 'store')->name('product.store');
    Route::get('/product/{product}/edit', 'edit')->name('product.edit');
    Route::put('/product/{product}', 'update')->name('product.update');
    Route::delete('/product/{product}', 'destroy')->name('product.destory');
});