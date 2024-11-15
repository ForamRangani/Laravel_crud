<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ContactController;

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


require __DIR__.'/admin.php';
