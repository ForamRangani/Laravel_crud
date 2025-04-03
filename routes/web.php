<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[SiteController::class,'home'])->name('home.index');
Route::get('product',[SiteController::class,'product'])->name('product.product');
Route::get('cart',[SiteController::class,'cart'])->name('cart.cart');
Route::get('blog',[SiteController::class,'blog'])->name('blog.blog');
Route::get('about',[SiteController::class,'about'])->name('about.about');
Route::get('contact',[SiteController::class,'contact'])->name('contact.contact');
Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
