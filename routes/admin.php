<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;


Route::get('index',[AdminController::class,'index'])->name('index.index');
// Route::get('/products', [ProductController::class, 'showProducts'])->name('products.show');

Route::prefix('categories')->name('category.')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');

});

Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
Route::get('/get-subcategories', [ProductController::class, 'getSubcategories'])->name('getSubcategories');
// Route::get('subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
// Route::put('subcategory/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
