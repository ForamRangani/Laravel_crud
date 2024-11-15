<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return response()->json([
        'Hello'
    ]);
});
Route::post('category',[CategoryController::class,'index']);
Route::post('category/store',[CategoryController::class,'store']);
Route::post('category/edit/{id}',[CategoryController::class,'edit']);
Route::post('category/update/{id}',[CategoryController::class,'update']);
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);
